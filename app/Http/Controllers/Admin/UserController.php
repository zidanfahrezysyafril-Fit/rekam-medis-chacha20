<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function store(Request $request)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function edit(User $user)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function update(Request $request, User $user)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }

    public function destroy(User $user)
    {
        abort(403, 'Akses ditolak. Admin hanya dapat melihat data.');
    }
}
