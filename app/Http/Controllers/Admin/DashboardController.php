<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalMahasiswa' => Mahasiswa::count(),
            'totalDosen' => Dosen::count(),
            'totalPengajuan' => PengajuanJudul::count(),
            'totalBimbingan' => Bimbingan::count(),
        ]);
    }
}