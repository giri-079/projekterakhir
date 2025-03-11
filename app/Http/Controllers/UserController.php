<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('user.create');
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', // ✅ Tambahkan username (wajib unik)
            'email' => 'required|email|unique:users',
            'nisn' => 'nullable|string|max:255|unique:users', // ✅ Boleh NULL
            'password' => 'required|min:6|confirmed',
            'level' => 'required|in:guru,siswa,admin',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username, // ✅ Simpan username
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan form edit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id, // ✅ Validasi username unik
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6', // ✅ Password opsional
            'level' => 'required|in:guru,siswa,admin',
            'nisn' => 'nullable|string|max:255|unique:users,nisn,' . $user->id, // ✅ Boleh NULL, tapi unik jika diisi
        ]);

        // Jika password diisi, hash sebelum update
        $password = $request->password ? Hash::make($request->password) : $user->password;

        $user->update([
            'name' => $request->name,
            'username' => $request->username, // ✅ Perbarui username
            'email' => $request->email,
            'password' => $password,
            'level' => $request->level,
            'nisn' => $request->nisn, 
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    // Menampilkan form edit password
    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('user.editpassword', compact('user'));
    }

    // Memperbarui password user
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.password.edit', $id)->with('success', 'Password berhasil diperbarui!');
    }

    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
