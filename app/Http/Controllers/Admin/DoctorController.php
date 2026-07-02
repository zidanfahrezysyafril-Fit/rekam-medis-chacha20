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
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function store(Request $request)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function edit(Doctor $doctor)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function update(Request $request, Doctor $doctor)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function destroy(Doctor $doctor)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }
}
