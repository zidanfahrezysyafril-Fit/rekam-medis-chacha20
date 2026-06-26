<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
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
            'nik' => 'required|string|max:20|unique:patients',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'date_of_birth' => 'required|date',
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'blood_type' => 'nullable|string|max:3',
        ]);

        // Create User account for the patient
        // Based on Patient Dashboard logic, patient is matched by email=nik or name=full_name. 
        // We will set the email to the provided email, and name to full_name.
        $user = User::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'patient',
        ]);

        // Create Patient profile
        Patient::create([
            'nik' => $validated['nik'],
            'full_name' => $validated['full_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
            'blood_type' => $validated['blood_type'],
        ]);

        \App\Services\ActivityLogger::log('Menambahkan pasien baru: ' . $validated['full_name']);

        return redirect()->route('admin.patients.index')->with('success', 'Data Pasien berhasil ditambahkan.');
    }

    public function show(Patient $patient)
    {
        // Not used, redirect to index
        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'max:20', Rule::unique('patients')->ignore($patient->id)],
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'blood_type' => 'nullable|string|max:3',
        ]);

        $patient->update($validated);

        \App\Services\ActivityLogger::log('Memperbarui data pasien: ' . $patient->full_name);

        return redirect()->route('admin.patients.index')->with('success', 'Data Pasien berhasil diperbarui.');
    }

    public function destroy(Patient $patient)
    {
        $name = $patient->full_name;
        
        User::where('name', $name)->where('role', 'patient')->delete();
        $patient->delete();

        \App\Services\ActivityLogger::log('Menghapus data pasien: ' . $name);

        return redirect()->route('admin.patients.index')->with('success', 'Data Pasien berhasil dihapus.');
    }
}
