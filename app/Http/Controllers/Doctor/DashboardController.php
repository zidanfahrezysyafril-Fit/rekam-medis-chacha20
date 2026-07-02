<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = \App\Models\Doctor::where('doctor_name', auth()->user()->name)->first();
        $stats = [
            'total_patients' => \App\Models\Patient::count(),
            'my_records' => $doctor ? \App\Models\MedicalRecord::where('doctor_id', $doctor->id)->count() : 0,
        ];

        return view('doctor.dashboard', compact('stats', 'doctor'));
    }

    public function updateProfile(Request $request)
    {
        $doctor = \App\Models\Doctor::where('doctor_name', auth()->user()->name)->first();
        if (!$doctor) {
            return redirect()->route('doctor.dashboard')->with('error', 'Profil dokter tidak ditemukan.');
        }

        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'sip_number' => 'required|string|unique:doctors,sip_number,' . $doctor->id,
            'specialization' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $doctor->update([
            'doctor_name' => $request->doctor_name,
            'sip_number' => $request->sip_number,
            'specialization' => $request->specialization,
            'phone_number' => $request->phone_number,
        ]);

        // Update the user's name as well to keep them linked
        auth()->user()->update(['name' => $request->doctor_name]);

        return redirect()->route('doctor.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }
}
