<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\RiwayatKelas;
use App\Models\Izin;
use App\Models\Guru; // Import model Guru
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Menampilkan daftar kelas
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Ambil data kelas beserta guru (wali kelas)
        $kelass = Kelas::with('guru')
                        ->when($search, function ($query) use ($search) {
                            $query->where('nama_kelas', 'like', "%$search%");
                        })
                        ->get();

        return view('kelas.index', compact('kelass'));
    }

    // Menampilkan form tambah kelas
    public function create()
    {
        $gurus = Guru::all(); // Ambil semua guru
        $kelass = Kelas::all(); // Ambil semua kelas
    
        return view('kelas.create', compact('gurus', 'kelass'));
    }
    


    // Menyimpan data kelas ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_kelas' => 'required|string|unique:kelas,id_kelas', // ID Kelas harus unik
            'nama_kelas' => 'required|string|max:50',
            'id_guru' => 'required|exists:guru,id_guru',
        ]);
    
        // Simpan ke database
        Kelas::create([
            'id_kelas' => $request->id_kelas,
            'nama_kelas' => $request->nama_kelas,
            'id_guru' => $request->id_guru,
        ]);
    
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }
    
    
    

    // Menampilkan form edit kelas
    public function edit($id)
    {
        // dd($id);
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all(); // Ambil semua guru agar bisa dipilih kembali
        return view('kelas.edit', compact('kelas', 'gurus'));
    }

    // Memperbarui data kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'id_guru' => 'required|exists:guru,id_guru',
            // 'nama_guru' => 'required',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'id_guru' => $request->id_guru,
            // 'nama_guru' => $request->nama_guru,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    // Menghapus data kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        // Hapus semua data terkait di tabel izin
        Izin::where('id_kelas', $id)->delete();

        // Hapus semua data terkait di riwayat_kelas
        RiwayatKelas::where('id_kelas', $id)->delete();

        // Hapus kelasnya
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
