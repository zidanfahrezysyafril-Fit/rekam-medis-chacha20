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

        return view('doctor.dashboard', compact('stats'));
    }
}
