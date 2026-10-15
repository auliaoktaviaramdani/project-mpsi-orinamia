<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AkunController extends Controller
{
    public function index()
    {
        $akuns = User::orderBy('name')->get();
        return view('master.akun.index', compact('akuns'));
    }

    public function create()
    {
        return view('master.akun.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role'     => ['required', Rule::in(['admin', 'owner'])],
        ]);

        User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit(User $akun)
    {
        return view('master.akun.edit', compact('akun'));
    }

    public function update(Request $request, User $akun)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($akun->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'role'     => ['required', Rule::in(['admin', 'owner'])],
        ]);

        $data = [
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'role'     => $validated['role'],
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $akun->update($data);

        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $akun)
    {
        if ($akun->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun yang sedang digunakan.');
        }

        $akun->delete();

        return redirect()->route('akun.index')
            ->with('success', 'Akun berhasil dihapus.');
    }
}
