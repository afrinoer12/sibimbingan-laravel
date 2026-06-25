<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanJudulController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            abort(403, 'Data mahasiswa belum tersedia.');
        }

        $pengajuan = PengajuanJudul::where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        return view('mahasiswa.pengajuan-judul.index', compact('pengajuan'));
    }

    public function create()
    {
        return view('mahasiswa.pengajuan-judul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'latar_belakang' => 'nullable|string',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            abort(403, 'Data mahasiswa belum tersedia.');
        }

        PengajuanJudul::create([
            'mahasiswa_id' => $mahasiswa->id,
            'judul' => $request->judul,
            'latar_belakang' => $request->latar_belakang,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('mahasiswa.pengajuan-judul.index')
            ->with('success', 'Judul skripsi berhasil diajukan.');
    }
}