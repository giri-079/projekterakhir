<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatKelas;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;

class RiwayatKelasController extends Controller
{
    public function index(Request $request)
    {
        $query = RiwayatKelas::with(['siswa', 'kelas', 'tahunajaran']); // Pastikan relasi dimuat
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama', 'LIKE', "%$search%");
            })->orWhereHas('kelas', function ($q) use ($search) {
                $q->where('nama_kelas', 'LIKE', "%$search%");
            });
        }
    
        $riwayatKelas = $query->paginate(10);
    
        return view('riwayatkelas.index', compact('riwayatKelas'));
    }
    
    
    
    


    public function create()
    {
        $siswaList = Siswa::all(); // Pastikan model Siswa ada
        $kelasList = Kelas::all(); // Pastikan model Kelas ada
        $tahunList = TahunAjaran::all(); // Pastikan model Kelas ada

        return view('riwayatkelas.create', compact('siswaList', 'kelasList', 'tahunList'));
    }


    public function store(Request $request)
{
    $request->validate([
        'nisn' => 'required|exists:siswa,nisn',  // Pastikan nisn ada di tabel siswa
        'id_kelas' => 'required',
        'id_tahunajaran' => 'required',
        'status' => 'required',
    ]);

    RiwayatKelas::create([
        'nisn' => $request->nisn,
        'id_kelas' => $request->id_kelas,
        'id_tahunajaran' => $request->id_tahunajaran,
        'status' => $request->status,
    ]);

    return redirect()->route('riwayatkelas.index')->with('success', 'Data berhasil ditambahkan!');
}

    
    
public function edit($id)
{
    $riwayatKelas = RiwayatKelas::findOrFail($id);
    $siswaList = Siswa::all();
    $kelasList = Kelas::all();
    $tahunList = TahunAjaran::all();

    return view('riwayatkelas.edit', compact('riwayatKelas', 'siswaList', 'kelasList', 'tahunList'));
}

    



public function update(Request $request, $id)
{
    $request->validate([
        'nisn' => 'required|exists:siswa,nisn',  // Pastikan nisn ada di tabel siswa
        'id_kelas' => 'required',
        'id_tahunajaran' => 'required',
        'status' => 'required',
    ]);

    $riwayatKelas = RiwayatKelas::findOrFail($id);
    $riwayatKelas->update([
        'nisn' => $request->nisn,
        'id_kelas' => $request->id_kelas,
        'id_tahunajaran' => $request->id_tahunajaran,
        'status' => $request->status,
    ]);

    return redirect()->route('riwayatkelas.index')->with('success', 'Data berhasil diperbarui');
}


    public function destroy($id)
    {
        $riwayatKelas = RiwayatKelas::findOrFail($id);
        $riwayatKelas->delete();

        return redirect()->route('riwayatkelas.index')->with('success', 'Data berhasil dihapus.');
    }
}
