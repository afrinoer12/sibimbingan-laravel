<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\PengajuanJudul;
use Illuminate\Http\Request;

class PengajuanJudulController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanJudul::with(['mahasiswa', 'dosen'])
            ->latest()
            ->get();

        return view('admin.pengajuan-judul.index', compact('pengajuan'));
    }

    public function edit(int $id)
    {
        $pengajuan = PengajuanJudul::with(['mahasiswa', 'dosen'])
            ->findOrFail($id);

        $dosens = Dosen::orderBy('nama', 'asc')->get();

        return view('admin.pengajuan-judul.edit', compact('pengajuan', 'dosens'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $pengajuan = PengajuanJudul::findOrFail($id);

        $pengajuan->update([
            'dosen_id' => $request->dosen_id,
        ]);

        return redirect()
            ->route('admin.pengajuan-judul.index')
            ->with('success', 'Dosen pembimbing berhasil ditentukan.');
    }
}