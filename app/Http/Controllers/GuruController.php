<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Menampilkan data guru
    public function index(Request $request)
    {
        $search = $request->input('search');

        $gurus = Guru::when($search, function ($query, $search) {
            return $query->where('id_guru', 'like', "%$search%")
                         ->orWhere('nama_guru', 'like', "%$search%");
        })->get();

        return view('guru.index', compact('gurus'));
    }

    // Menampilkan form untuk menambah guru
    public function create()
    {
        return view('guru.create');
    }

    // Menyimpan data guru ke database
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_guru' => 'required',
            'nama_guru' => 'required',
            'status' => 'required|in:0,1',
        ]);

        // Pastikan ada nilai untuk 'status' pada saat membuat data
        $guru = new Guru();
        $guru->id_guru = $request->id_guru;
        $guru->nama_guru = $request->nama_guru;
        $guru->status = $request->status; // Pastikan kolom status mendapatkan nilai
        $guru->save();

        // Redirect ke halaman index guru
        return redirect()->route('guru.index');
    }

    // Menampilkan form untuk mengedit data guru
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);  // Mencari data guru berdasarkan id
        return view('guru.edit', compact('guru'));
    }

    // Memperbarui data guru
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:50',
            'status' => 'required|numeric|max:1',
        ]);

        $guru = Guru::findOrFail($id);  // Mencari data guru berdasarkan id
        $guru->update($request->all());  // Memperbarui data guru

        return redirect()->route('guru.index');
    }

    // Menghapus data guru
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()->route('guru.index');
    }
}
