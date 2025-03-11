<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // Menentukan nama tabel yang digunakan
    protected $table = 'siswa';  // Pastikan nama tabel sesuai dengan yang ada di database

    // Menentukan primary key yang digunakan
    protected $primaryKey = 'nisn';

    // Jika tipe data dari 'nisn' bukan integer, kita bisa set tipe data key
    protected $keyType = 'string';

    // Jika tidak menggunakan kolom created_at dan updated_at, matikan timestamps
    public $timestamps = false;  // Set ke true jika Anda menggunakan timestamps

    // Menambahkan kolom yang dapat diisi secara massal
    protected $fillable = [
        'nisn',
        'nama',
        'tempatlahir',
        'tgllahir',
        'alamat'
    ];

    // Relasi ke model RiwayatKelas
    public function riwayatKelas()
    {
        return $this->hasMany(RiwayatKelas::class, 'nisn' , 'nisn');
    }
}
