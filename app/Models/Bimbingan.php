<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bimbingan extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',
        'pengajuan_judul_id',
        'tanggal_bimbingan',
        'topik_bimbingan',
        'catatan_mahasiswa',
        'catatan_dosen',
        'status',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    public function pengajuanJudul(): BelongsTo
    {
        return $this->belongsTo(PengajuanJudul::class);
    }

    public function fileSkripsi(): HasMany
    {
        return $this->hasMany(FileSkripsi::class);
    }

    public function catatanRevisi(): HasMany
    {
        return $this->hasMany(CatatanRevisi::class);
    }
}