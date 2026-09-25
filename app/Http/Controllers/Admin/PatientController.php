<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityLogger;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('full_name', 'like', "%{$search}%");
        }

        $patients = $query->latest()->paginate(10);
        
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $hash = hash_hmac('sha256', $value, config('app.key'));
                    if (User::where('email_hash', $hash)->exists()) {
                        $fail('Email sudah terdaftar di sistem.');
                    }
                }
            ],
            'password' => 'required|string|min:8',
            'nik' => [
                'required', 'string', 'max:20',
                function ($attribute, $value, $fail) {
                    $hash = hash_hmac('sha256', $value, config('app.key'));
                    if (Patient::where('nik_hash', $hash)->exists()) {
                        $fail('NIK sudah terdaftar di sistem.');
                    }
                }
            ],
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'phone_number' => 'required|string|max:20',
            'blood_type' => 'nullable|string',
            'address' => 'required|string',
        ]);

        $emailHash = hash_hmac('sha256', $validated['email'], config('app.key'));

        User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'email_hash' => $emailHash,
            'password' => Hash::make($validated['password']),
            'role' => 'patient',
        ]);

        Patient::create([
            'nik' => $validated['nik'],
            'nik_hash' => hash_hmac('sha256', $validated['nik'], config('app.key')),
            'full_name' => $validated['full_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'blood_type' => $validated['blood_type'],
            'address' => $validated['address'],
        ]);

        ActivityLogger::log('Menambahkan pasien baru: ' . $validated['full_name']);

        return redirect()->route('admin.patients.index')->with('success', 'Data Pasien & Akun berhasil dibuat.');
    }

    public function show(Patient $patient)
    {
        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'nik' => [
                'required', 'string', 'max:20',
                function ($attribute, $value, $fail) use ($patient) {
                    $hash = hash_hmac('sha256', $value, config('app.key'));
                    if (Patient::where('nik_hash', $hash)->where('id', '!=', $patient->id)->exists()) {
                        $fail('NIK sudah terdaftar di sistem.');
                    }
                }
            ],
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'phone_number' => 'required|string|max:20',
            'blood_type' => 'nullable|string',
            'address' => 'required|string',
        ]);

        $oldName = $patient->full_name;

        $patient->update([
            'nik' => $validated['nik'],
            'nik_hash' => hash_hmac('sha256', $validated['nik'], config('app.key')),
            'full_name' => $validated['full_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'blood_type' => $validated['blood_type'],
            'address' => $validated['address'],
        ]);

        // Keep User name synced if exists
        User::where('name', $oldName)->where('role', 'patient')->update(['name' => $validated['full_name']]);

        ActivityLogger::log('Memperbarui data pasien: ' . $validated['full_name']);

        return redirect()->route('admin.patients.index')->with('success', 'Data Pasien berhasil diperbarui.');
    }

    public function destroy(Patient $patient)
    {
        $name = $patient->full_name;

        User::where('name', $name)->where('role', 'patient')->delete();
        $patient->delete();

        ActivityLogger::log('Menghapus data pasien: ' . $name);

        return redirect()->route('admin.patients.index')->with('success', 'Data Pasien berhasil dihapus.');
    }
}
