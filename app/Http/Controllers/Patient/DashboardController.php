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
}
