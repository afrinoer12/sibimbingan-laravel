<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'user_id',
        'nidn',
        'nama',
        'program_studi',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mahasiswaBimbingan()
    {
        return $this->hasMany(PengajuanJudul::class);
    }

    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }
}