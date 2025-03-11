<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswa = Siswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%")
                         ->orWhere('nisn', 'like', "%$search%");
        })->get();

        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nisn' => 'required|numeric|unique:siswa,nisn',
            'nama' => 'required|string|max:255',
            'tempatlahir' => 'required|string|max:255',
            'tgllahir' => 'required|date',
            'alamat' => 'required|string|max:500',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function edit($nisn)
    {
        // Cari siswa berdasarkan NISN
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $nisn)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempatlahir' => 'required|string|max:255',
            'tgllahir' => 'required|date',
            'alamat' => 'required|string|max:500',
        ]);
        
        // Cari siswa berdasarkan NISN
        $siswa = Siswa::where('nisn', $nisn)->first();
        
        // Jika siswa tidak ditemukan
        if (!$siswa) {
            return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan!');
        }
        
        // Update data siswa
        $siswa->update([
            'nama' => $request->nama,
            'tempatlahir' => $request->tempatlahir,
            'tgllahir' => $request->tgllahir,
            'alamat' => $request->alamat,
        ]);
        
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }
    

    public function destroy($nisn)
    {
        // Cari siswa berdasarkan NISN
        $siswa = Siswa::where('nisn', $nisn)->firstOrFail();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
