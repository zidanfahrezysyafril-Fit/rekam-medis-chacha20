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
            $query->where('full_name', 'like', "%{$search}%");
        }

        $patients = $query->latest()->paginate(10);
        
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function store(Request $request)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function show(Patient $patient)
    {
        // Not used, redirect to index
        return redirect()->route('admin.patients.index');
    }

    public function edit(Patient $patient)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function update(Request $request, Patient $patient)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function destroy(Patient $patient)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }
}
