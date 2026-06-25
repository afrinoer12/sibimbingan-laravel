<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\FileSkripsi;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        $bimbingan = Bimbingan::with(['dosen', 'pengajuanJudul', 'fileSkripsi'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->latest()
            ->get();

        return view('mahasiswa.bimbingan.index', compact('bimbingan'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        $pengajuanJudul = PengajuanJudul::with('dosen')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'disetujui')
            ->whereNotNull('dosen_id')
            ->latest()
            ->get();

        return view('mahasiswa.bimbingan.create', compact('pengajuanJudul'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengajuan_judul_id' => 'required|exists:pengajuan_juduls,id',
            'tanggal_bimbingan' => 'required|date',
            'topik_bimbingan' => 'required|string|max:255',
            'catatan_mahasiswa' => 'nullable|string',
            'jenis_file' => 'required|string|max:50',
            'file_skripsi' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        $pengajuan = PengajuanJudul::where('id', $request->pengajuan_judul_id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status', 'disetujui')
            ->firstOrFail();

        $bimbingan = Bimbingan::create([
            'mahasiswa_id' => $mahasiswa->id,
            'dosen_id' => $pengajuan->dosen_id,
            'pengajuan_judul_id' => $pengajuan->id,
            'tanggal_bimbingan' => $request->tanggal_bimbingan,
            'topik_bimbingan' => $request->topik_bimbingan,
            'catatan_mahasiswa' => $request->catatan_mahasiswa,
            'status' => 'menunggu',
        ]);

        $file = $request->file('file_skripsi');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('skripsi', $namaFile, 'public');

        FileSkripsi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'bimbingan_id' => $bimbingan->id,
            'nama_file' => $namaFile,
            'file_path' => $path,
            'jenis_file' => $request->jenis_file,
        ]);

        return redirect()
            ->route('mahasiswa.bimbingan.index')
            ->with('success', 'Bimbingan dan file skripsi berhasil dikirim.');
    }

    public function show(int $id)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->firstOrFail();

        $bimbingan = Bimbingan::with(['dosen', 'pengajuanJudul', 'fileSkripsi', 'catatanRevisi'])
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('mahasiswa.bimbingan.show', compact('bimbingan'));
    }
}