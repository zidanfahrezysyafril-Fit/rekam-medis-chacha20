<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('doctor_name', 'like', "%{$search}%")
                  ->orWhere('specialization', 'like', "%{$search}%");
        }

        $doctors = $query->latest()->paginate(10);
        
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'sip_number' => 'required|string|max:50|unique:doctors',
            'specialization' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
        ]);

        // Create User account for the doctor
        $user = User::create([
            'name' => $validated['doctor_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'doctor',
        ]);

        // Create Doctor profile
        Doctor::create([
            'doctor_name' => $validated['doctor_name'],
            'sip_number' => $validated['sip_number'],
            'specialization' => $validated['specialization'],
            'phone_number' => $validated['phone_number'],
        ]);

        \App\Services\ActivityLogger::log('Menambahkan dokter baru: ' . $validated['doctor_name']);

        return redirect()->route('admin.doctors.index')->with('success', 'Data Dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $doctor)
    {
        // Try to find the associated user account (by name or email if possible, but schema doesn't link them directly by user_id)
        // Since schema for doctors doesn't have user_id, we will just update the doctor info.
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'sip_number' => ['required', 'string', 'max:50', Rule::unique('doctors')->ignore($doctor->id)],
            'specialization' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
        ]);

        $doctor->update($validated);

        \App\Services\ActivityLogger::log('Memperbarui data dokter: ' . $doctor->doctor_name);

        return redirect()->route('admin.doctors.index')->with('success', 'Data Dokter berhasil diperbarui.');
    }

    public function destroy(Doctor $doctor)
    {
        $name = $doctor->doctor_name;
        
        // Optionally delete the user account if name matches exactly
        User::where('name', $name)->where('role', 'doctor')->delete();
        
        $doctor->delete();

        \App\Services\ActivityLogger::log('Menghapus data dokter: ' . $name);

        return redirect()->route('admin.doctors.index')->with('success', 'Data Dokter berhasil dihapus.');
    }
}
