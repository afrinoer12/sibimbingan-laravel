<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        $pengajuan = PengajuanJudul::with('dosen')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        $bimbinganTerakhir = Bimbingan::where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->first();

        return view('mahasiswa.dashboard', compact(
            'pengajuan',
            'bimbinganTerakhir'
        ));
    }
}