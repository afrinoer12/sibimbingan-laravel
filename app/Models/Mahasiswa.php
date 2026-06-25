<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'prodi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengajuanJudul()
    {
        return $this->hasMany(PengajuanJudul::class);
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }
}