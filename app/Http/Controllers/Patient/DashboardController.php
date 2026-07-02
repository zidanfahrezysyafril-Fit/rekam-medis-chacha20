<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = \App\Models\Patient::where('nik', auth()->user()->email)->orWhere('full_name', auth()->user()->name)->first();
        
        $myRecords = [];
        if ($patient) {
            $myRecords = \App\Models\MedicalRecord::where('patient_id', $patient->id)->with('doctor')->latest()->take(5)->get();
        }

        return view('patient.dashboard', compact('patient', 'myRecords'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:patients,nik',
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'blood_type' => 'nullable|string|in:A,B,AB,O',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        // Create the patient profile
        \App\Models\Patient::create([
            'nik' => $request->nik,
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_type' => $request->blood_type,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        // Update the user's name so they remain linked
        auth()->user()->update(['name' => $request->full_name]);

        return redirect()->route('patient.dashboard')->with('success', 'Data profil berhasil disimpan dan ditautkan!');
    }

    public function updateProfile(Request $request)
    {
        $patient = \App\Models\Patient::where('nik', auth()->user()->email)->orWhere('full_name', auth()->user()->name)->first();
        if (!$patient) {
            return redirect()->route('patient.dashboard')->with('error', 'Profil tidak ditemukan.');
        }

        $request->validate([
            'nik' => 'required|string|size:16|unique:patients,nik,' . $patient->id,
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'blood_type' => 'nullable|string|in:A,B,AB,O',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $patient->update([
            'nik' => $request->nik,
            'full_name' => $request->full_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'blood_type' => $request->blood_type,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        // Update the user's name so they remain linked
        auth()->user()->update(['name' => $request->full_name]);

        return redirect()->route('patient.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }
}
