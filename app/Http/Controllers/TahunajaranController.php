<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $tahunajaran = TahunAjaran::when($search, function ($query) use ($search) {
            return $query->where('id_tahunajaran', 'like', "%$search%")
                         ->orWhere('tahun_ajaran', 'like', "%$search%");
        })->paginate(10);
    
        return view('tahunajaran.index', compact('tahunajaran'));
    }

    public function create()
    {
        // Return a view for creating a new TahunAjaran
        return view('tahunajaran.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tahun_ajaran' => 'required|max:50',  // Pastikan tahun_ajaran adalah string dengan panjang maksimum 50 karakter
            'status' => 'required|in:Aktif,Tidak Aktif', // Validasi status hanya bisa "Aktif" atau "Tidak Aktif"
        ]);

        // Simpan data ke dalam database
        $tahunAjaran = new TahunAjaran();
        $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
        $tahunAjaran->status = $request->status;
        $tahunAjaran->save();

        // Redirect setelah sukses
        return redirect()->route('tahunajaran.index')->with('success', 'Tahun Ajaran berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menampilkan data tahun ajaran berdasarkan ID
        return response()->json(TahunAjaran::findOrFail($id));
    }

    public function edit($id)
    {
        // Menampilkan form edit dengan data tahun ajaran berdasarkan ID
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('tahunajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'tahun_ajaran' => 'required|max:50', // Validasi panjang tahun_ajaran
            'status' => 'required|in:0,1', // Validasi status hanya bisa "Aktif" atau "Tidak Aktif"
        ]);

        // Cari dan update data tahun ajaran
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
        $tahunAjaran->status = $request->status;
        $tahunAjaran->save();

        // Redirect ke halaman daftar tahun ajaran dengan pesan sukses
        return redirect()->route('tahunajaran.index')->with('success', 'Tahun Ajaran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Hapus data tahun ajaran
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->delete();

        // return response()->with(['message' => 'Data berhasil dihapus']);
        return redirect()->route('tahunajaran.index')->with('success', 'Tahun Ajaran berhasil dihapus!');
    }
}
