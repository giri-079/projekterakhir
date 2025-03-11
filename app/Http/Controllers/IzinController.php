<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class IzinController extends Controller
{
    // Menampilkan semua data izin
    public function index(Request $request)
    {
        $search = $request->input('search');

        $izin = Izin::with(['siswa', 'kelas', 'tahunajaran'])
            ->when($search, function ($query, $search) {
                return $query->where('nisn', 'LIKE', "%$search%")
                            ->orWhere('alasan', 'LIKE', "%$search%");
            })
            ->paginate(10);

        return view('izin.index', compact('izin'));
    }

    // Menampilkan form tambah izin
    public function create()
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahunajaran = TahunAjaran::all();

        return view('izin.create', compact('siswa', 'kelas', 'tahunajaran'));
    }

    // Menyimpan data izin baru
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'id_kelas' => 'required',
            'id_tahunajaran' => 'required',
            'alasan' => 'required|max:255',
            'kategori' => 'required',
            'tanggal_mulai_izin' => 'required|date',
            'tanggal_akhir_izin' => 'required|date|after_or_equal:tanggal_mulai_izin',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
        ]);
    
        $izin = new Izin();
        $izin->nisn = $request->nisn;
        $izin->id_kelas = $request->id_kelas;
        $izin->id_tahunajaran = $request->id_tahunajaran;
        $izin->alasan = $request->alasan;
        $izin->kategori = $request->kategori;
        $izin->tanggal_mulai_izin = $request->tanggal_mulai_izin;
        $izin->tanggal_akhir_izin = $request->tanggal_akhir_izin;
        $izin->status = $request->status;
    
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti', 'public');
            $izin->bukti = $path;
        }
    
        $izin->save();
    
        return redirect()->route('izin.index')->with('success', 'Izin berhasil ditambahkan.');
    }
    

    // Menampilkan form edit izin
    public function edit($id)
    {
        $izin = Izin::findOrFail($id);
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $tahun_ajaran = TahunAjaran::all();

        return view('izin.edit', compact('izin', 'siswa', 'kelas', 'tahun_ajaran'));
    }

    // Memperbarui data izin
    public function update(Request $request, $id)
    {
        Log::info('Data Diterima:', $request->all());
    
        $izin = Izin::findOrFail($id);
    
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'alasan' => 'required|string|max:255',
            'kategori' => 'required|in:sakit,dispen',
            'tanggal_mulai_izin' => 'required|date',
            'tanggal_akhir_izin' => 'required|date|after_or_equal:tanggal_mulai_izin',
            'status' => 'required|in:menunggu,diizinkan,ditolak', // Tambahkan validasi status
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        Log::info('Status sebelum update: ' . $izin->status);
        Log::info('Status baru: ' . $request->status);
    
        // Cek apakah ada file baru diunggah
        if ($request->hasFile('bukti')) {
            // Hapus bukti lama jika ada
            if ($izin->bukti) {
                Storage::delete('public/' . $izin->bukti);
            }
            $buktiPath = $request->file('bukti')->store('bukti_izin', 'public');
        } else {
            $buktiPath = $izin->bukti;
        }
    
        // Pastikan status diperbarui
        $izin->status = $request->status;
        $izin->nisn = $request->nisn;
        $izin->alasan = $request->alasan;
        $izin->kategori = $request->kategori;
        $izin->tanggal_mulai_izin = $request->tanggal_mulai_izin;
        $izin->tanggal_akhir_izin = $request->tanggal_akhir_izin;
        $izin->bukti = $buktiPath;
    
        $izin->save(); // Simpan perubahan
    
        Log::info('Status setelah update: ' . $izin->fresh()->status);
        Log::info('Bukti setelah update: ' . $buktiPath);
    
        return redirect()->route('izin.index')->with('success', 'Data izin berhasil diperbarui');
    }
    
    

    // Menghapus izin
    public function destroy($id)
    {
        $izin = Izin::findOrFail($id);

        // Hapus file bukti jika ada
        if ($izin->bukti) {
            Storage::delete('public/' . $izin->bukti);
        }

        $izin->delete();

        return redirect()->route('izin.index')->with('success', 'Data izin berhasil dihapus');
    }

    // Menampilkan detail izin
    public function show($id)
    {
        $izin = Izin::with('siswa')->findOrFail($id);
        return view('izin.show', compact('izin'));
    }
}
