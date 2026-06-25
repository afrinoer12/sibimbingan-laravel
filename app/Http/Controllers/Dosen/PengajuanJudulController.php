<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\PengajuanJudul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanJudulController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $pengajuan = PengajuanJudul::with(['mahasiswa', 'dosen'])
            ->where('dosen_id', $dosen->id)
            ->latest()
            ->get();

        return view('dosen.pengajuan-judul.index', compact('pengajuan'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,revisi',
            'catatan' => 'nullable|string',
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $pengajuan = PengajuanJudul::where('dosen_id', $dosen->id)
            ->where('id', $id)
            ->firstOrFail();

        $pengajuan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('dosen.pengajuan-judul.index')
            ->with('success', 'Status pengajuan judul berhasil diperbarui.');
    }
}