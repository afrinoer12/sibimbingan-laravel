<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\CatatanRevisi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $bimbingan = Bimbingan::with(['mahasiswa', 'pengajuanJudul', 'fileSkripsi'])
            ->where('dosen_id', $dosen->id)
            ->latest()
            ->get();

        return view('dosen.bimbingan.index', compact('bimbingan'));
    }

    public function show(int $id)
    {
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $bimbingan = Bimbingan::with(['mahasiswa', 'pengajuanJudul', 'fileSkripsi', 'catatanRevisi'])
            ->where('dosen_id', $dosen->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('dosen.bimbingan.show', compact('bimbingan'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'catatan_dosen' => 'required|string',
            'status' => 'required|in:menunggu,diproses,revisi,selesai,disetujui',
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $bimbingan = Bimbingan::where('dosen_id', $dosen->id)
            ->where('id', $id)
            ->firstOrFail();

        $bimbingan->update([
            'catatan_dosen' => $request->catatan_dosen,
            'status' => $request->status,
        ]);

        CatatanRevisi::create([
            'bimbingan_id' => $bimbingan->id,
            'dosen_id' => $dosen->id,
            'catatan' => $request->catatan_dosen,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('dosen.bimbingan.show', $bimbingan->id)
            ->with('success', 'Catatan bimbingan berhasil disimpan.');
    }
}