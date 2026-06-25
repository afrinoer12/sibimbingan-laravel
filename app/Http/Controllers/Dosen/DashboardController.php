<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\PengajuanJudul;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $pengajuan = PengajuanJudul::with(['mahasiswa', 'dosen'])
            ->where('dosen_id', $dosen->id)
            ->latest()
            ->get();

        $totalBimbingan = Bimbingan::where('dosen_id', $dosen->id)->count();

        $bimbinganMenunggu = Bimbingan::where('dosen_id', $dosen->id)
            ->where('status', 'menunggu')
            ->count();

        $bimbinganDiproses = Bimbingan::where('dosen_id', $dosen->id)
            ->where('status', 'diproses')
            ->count();

        $bimbinganRevisi = Bimbingan::where('dosen_id', $dosen->id)
            ->where('status', 'revisi')
            ->count();

        $bimbinganDisetujui = Bimbingan::where('dosen_id', $dosen->id)
            ->where('status', 'disetujui')
            ->count();

        return view('dosen.dashboard', compact(
            'pengajuan',
            'totalBimbingan',
            'bimbinganMenunggu',
            'bimbinganDiproses',
            'bimbinganRevisi',
            'bimbinganDisetujui'
        ));
    }
}