<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKelas extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kelas';
    protected $fillable = ['nisn', 'id_kelas', 'id_tahunajaran', 'status'];

    public $timestamps = false;

    protected $primaryKey = 'id_riwayatkelas';

    // Relasi ke model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Relasi ke model TahunAjaran
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunajaran', 'id_tahunajaran');
    }
}

