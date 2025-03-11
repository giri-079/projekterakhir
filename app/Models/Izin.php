<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $table = 'izin';
    protected $primaryKey = 'id_perizinan';

    protected $fillable = [
        'nisn', 'id_tahunajaran', 'alasan', 'kategori', 'tanggal_mulai_izin',
        'tanggal_akhir_izin', 'status', 'bukti', 'id_kelas'
    ];

    public $timestamps = false;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahunajaran', 'id_tahunajaran');
    }
}

