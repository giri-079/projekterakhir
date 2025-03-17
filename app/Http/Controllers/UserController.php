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
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'nisn' => 'nullable|numeric|digits:10|unique:users',
            'password' => 'required|min:6|confirmed',
            'level' => 'required|string', // ✅ Sesuai dengan form
        ]);
    
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nisn' => $request->nisn,
            'password' => Hash::make($request->password),
            'level' => $request->level, // ✅ Role diambil dari form
        ]);
    
        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }


    // Menampilkan form edit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Memperbarui data user (dengan opsi update password)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'nisn' => 'nullable|numeric|digits:10|unique:users,nisn,' . $user->id,
            'level' => 'required|string',
        ]);
    
        // Jika password diisi, hash dulu sebelum update
        $password = $request->password ? Hash::make($request->password) : $user->password;
    
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $password,
            'nisn' => $request->nisn,
            'level' => $request->level, // ✅ Role diperbarui sesuai input form
        ]);
    
        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }
    




    public function editPassword($id)
    {
        $user = User::findOrFail($id);
        return view('user.editpassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        // $user->password = bcrypt($request->password);
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->route('user.password.edit', $id)->with('success', 'Password berhasil diperbarui!');
    }



    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
