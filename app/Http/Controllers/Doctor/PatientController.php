<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchHash = hash_hmac('sha256', $search, config('app.key'));
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nik_hash', $searchHash);
        }

        $patients = $query->latest()->paginate(10);
        return view('doctor.patients.index', compact('patients'));
    }
}
