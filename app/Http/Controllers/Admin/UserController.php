<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Services\ActivityLogger;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchHash = hash_hmac('sha256', $search, config('app.key'));
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email_hash', $searchHash);
        }

        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) {
                    $hash = hash_hmac('sha256', $value, config('app.key'));
                    if (User::where('email_hash', $hash)->exists()) {
                        $fail('Email sudah terdaftar.');
                    }
                }
            ],
            'password' => ['required', Password::defaults()],
            'role' => 'required|in:admin,doctor,patient',
        ]);

        $emailHash = hash_hmac('sha256', $validated['email'], config('app.key'));

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_hash' => $emailHash,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        ActivityLogger::log('Menambahkan pengguna baru: ' . $validated['name'] . ' (' . $validated['role'] . ')');

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                function ($attribute, $value, $fail) use ($user) {
                    $hash = hash_hmac('sha256', $value, config('app.key'));
                    if (User::where('email_hash', $hash)->where('id', '!=', $user->id)->exists()) {
                        $fail('Email sudah terdaftar.');
                    }
                }
            ],
            'role' => 'required|in:admin,doctor,patient',
            'password' => ['nullable', Password::defaults()],
        ]);

        $emailHash = hash_hmac('sha256', $validated['email'], config('app.key'));

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_hash' => $emailHash,
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        ActivityLogger::log('Memperbarui data pengguna: ' . $user->name);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $name = $user->name;
        $user->delete();

        ActivityLogger::log('Menghapus pengguna: ' . $name);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
