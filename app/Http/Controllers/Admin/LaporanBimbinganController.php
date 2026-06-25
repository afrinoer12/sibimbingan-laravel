<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBimbinganController extends Controller
{
    public function index()
    {
        $bimbingan = Bimbingan::with([
            'mahasiswa',
            'dosen',
            'pengajuanJudul',
            'fileSkripsi',
            'catatanRevisi'
        ])
        ->latest()
        ->get();

        return view('admin.laporan-bimbingan.index', compact('bimbingan'));
    }

    public function exportPdf()
    {
        $bimbingan = Bimbingan::with([
            'mahasiswa',
            'dosen',
            'pengajuanJudul',
            'fileSkripsi',
            'catatanRevisi'
        ])
        ->latest()
        ->get();

        $pdf = Pdf::loadView('admin.laporan-bimbingan.pdf', compact('bimbingan'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-bimbingan-skripsi.pdf');
    }
}