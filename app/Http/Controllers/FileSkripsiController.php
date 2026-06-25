<?php

namespace App\Http\Controllers;

use App\Models\FileSkripsi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileSkripsiController extends Controller
{
    public function lihat(int $id)
    {
        $file = FileSkripsi::with(['mahasiswa', 'bimbingan.dosen'])->findOrFail($id);

        $user = Auth::user();

        if (!$user) {
            abort(403, 'Akses ditolak.');
        }

        /*
        |--------------------------------------------------------------------------
        | Validasi Akses File
        |--------------------------------------------------------------------------
        | Admin boleh lihat semua file.
        | Mahasiswa hanya boleh lihat file miliknya.
        | Dosen hanya boleh lihat file bimbingannya.
        */
        if ($user->role === 'mahasiswa') {
            if (!$user->mahasiswa || $file->mahasiswa_id !== $user->mahasiswa->id) {
                abort(403, 'Akses file ditolak.');
            }
        }

        if ($user->role === 'dosen') {
            if (!$user->dosen || !$file->bimbingan || $file->bimbingan->dosen_id !== $user->dosen->id) {
                abort(403, 'Akses file ditolak.');
            }
        }

        $path = $file->file_path;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan di storage.');
        }

        $fullPath = Storage::disk('public')->path($path);

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));

        if ($extension === 'pdf') {
            return response()->file($fullPath, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        return response()->download($fullPath, $file->nama_file);
    }
}