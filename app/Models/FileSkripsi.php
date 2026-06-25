<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileSkripsi extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'bimbingan_id',
        'nama_file',
        'file_path',
        'jenis_file',
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function bimbingan(): BelongsTo
    {
        return $this->belongsTo(Bimbingan::class);
    }
}