<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => \App\Models\User::count(),
            'doctors' => \App\Models\Doctor::count(),
            'patients' => \App\Models\Patient::count(),
            'medical_records' => \App\Models\MedicalRecord::count(),
        ];
        
        $recentActivities = \App\Models\ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}
