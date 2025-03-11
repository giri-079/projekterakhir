<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahunajaran'; // Sesuaikan dengan tabel di database

    protected $primaryKey = 'id_tahunajaran';

    public $timestamps = false;

    protected $fillable = ['tahun']; // Pastikan kolom 'tahun' menyimpan format 2024/2025

    // Relasi ke RiwayatKelas
    public function riwayatKelas()
    {
        return $this->hasMany(RiwayatKelas::class, 'id_tahunajaran', 'id_tahunajaran');
    }
}
