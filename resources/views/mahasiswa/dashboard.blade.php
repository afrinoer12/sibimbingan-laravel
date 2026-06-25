<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Dashboard Mahasiswa
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Pantau pengajuan judul, progress skripsi, dan riwayat bimbingan kamu.
                </p>
            </div>

            <div class="px-4 py-2 bg-white/10 border border-white/20 rounded-2xl text-sm text-white">
                {{ now()->format('d M Y') }}
            </div>
        </div>
    </x-slot>

    @php
        $pengajuan = $pengajuan ?? collect();
        $bimbinganTerakhir = $bimbinganTerakhir ?? null;

        $progress = 0;
        $statusProgress = 'Belum Mulai';
        $warnaProgress = 'bg-gray-400';
        $lebarProgress = 'w-0';

        if ($bimbinganTerakhir) {
            if ($bimbinganTerakhir->status == 'menunggu') {
                $progress = 20;
                $statusProgress = 'Menunggu Pemeriksaan';
                $warnaProgress = 'bg-yellow-500';
                $lebarProgress = 'w-1/5';
            } elseif ($bimbinganTerakhir->status == 'diproses') {
                $progress = 40;
                $statusProgress = 'Sedang Diproses';
                $warnaProgress = 'bg-blue-500';
                $lebarProgress = 'w-2/5';
            } elseif ($bimbinganTerakhir->status == 'revisi') {
                $progress = 60;
                $statusProgress = 'Revisi';
                $warnaProgress = 'bg-orange-500';
                $lebarProgress = 'w-3/5';
            } elseif ($bimbinganTerakhir->status == 'selesai') {
                $progress = 80;
                $statusProgress = 'Selesai Bimbingan';
                $warnaProgress = 'bg-purple-500';
                $lebarProgress = 'w-4/5';
            } elseif ($bimbinganTerakhir->status == 'disetujui') {
                $progress = 100;
                $statusProgress = 'Disetujui';
                $warnaProgress = 'bg-green-600';
                $lebarProgress = 'w-full';
            }
        }
    @endphp

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HERO CARD --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-blue-700 to-indigo-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-emerald-100 text-sm font-semibold">
                            Selamat Datang
                        </p>

                        <h1 class="text-3xl font-black mt-1">
                            {{ auth()->user()->name }}
                        </h1>

                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Ajukan judul skripsi, pantau status persetujuan, upload file bimbingan, dan lihat catatan revisi dari dosen pembimbing.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('mahasiswa.pengajuan-judul.index') }}"
                           class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                            Pengajuan Judul
                        </a>

                        <a href="{{ route('mahasiswa.bimbingan.index') }}"
                           class="px-5 py-3 bg-emerald-500 text-white rounded-2xl font-bold text-sm shadow hover:bg-emerald-600 transition">
                            Bimbingan Skripsi
                        </a>
                    </div>
                </div>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-7">

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Total Pengajuan</p>
                            <h2 class="text-4xl font-black text-gray-900 mt-2">
                                {{ $pengajuan->count() }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-black">
                            J
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Menunggu</p>
                            <h2 class="text-4xl font-black text-yellow-600 mt-2">
                                {{ $pengajuan->where('status', 'menunggu')->count() }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-2xl font-black">
                            M
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Disetujui</p>
                            <h2 class="text-4xl font-black text-green-600 mt-2">
                                {{ $pengajuan->where('status', 'disetujui')->count() }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-2xl font-black">
                            S
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Revisi / Ditolak</p>
                            <h2 class="text-4xl font-black text-red-600 mt-2">
                                {{ $pengajuan->whereIn('status', ['revisi', 'ditolak'])->count() }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center text-2xl font-black">
                            R
                        </div>
                    </div>
                </div>

            </div>

            {{-- PROGRESS SKRIPSI --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7 mb-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">
                            Status Progress Skripsi
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Progress dihitung berdasarkan status bimbingan terakhir.
                        </p>
                    </div>

                    <a href="{{ route('mahasiswa.bimbingan.index') }}"
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-2xl text-sm font-bold transition">
                        Lihat Bimbingan
                    </a>
                </div>

                <div class="flex justify-between mb-2">
                    <span class="text-sm font-bold text-gray-700">
                        {{ $statusProgress }}
                    </span>
                    <span class="text-sm font-black text-gray-900">
                        {{ $progress }}%
                    </span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-5 overflow-hidden">
                    <div class="{{ $warnaProgress }} {{ $lebarProgress }} h-5 rounded-full transition-all duration-500"></div>
                </div>

                @if (!$bimbinganTerakhir)
                    <p class="text-sm text-gray-500 mt-4">
                        Belum ada data bimbingan. Silakan ajukan bimbingan setelah judul skripsi disetujui.
                    </p>
                @else
                    <p class="text-sm text-gray-500 mt-4">
                        Status terakhir bimbingan kamu adalah
                        <strong>{{ ucfirst($bimbinganTerakhir->status) }}</strong>.
                    </p>
                @endif
            </div>

            {{-- ALUR BIMBINGAN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7 mb-7">
                <h3 class="text-xl font-black text-gray-900 mb-5">
                    Alur Bimbingan Skripsi
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="p-5 rounded-3xl bg-blue-50 border border-blue-100">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black mb-4">
                            1
                        </div>
                        <h4 class="font-black text-gray-900">Ajukan Judul</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Mahasiswa mengajukan judul skripsi melalui sistem.
                        </p>
                    </div>

                    <div class="p-5 rounded-3xl bg-indigo-50 border border-indigo-100">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-black mb-4">
                            2
                        </div>
                        <h4 class="font-black text-gray-900">Dosen Pembimbing</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Admin menentukan dosen pembimbing untuk mahasiswa.
                        </p>
                    </div>

                    <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100">
                        <div class="w-12 h-12 rounded-2xl bg-yellow-500 text-white flex items-center justify-center font-black mb-4">
                            3
                        </div>
                        <h4 class="font-black text-gray-900">Persetujuan</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Dosen menyetujui, merevisi, atau menolak judul.
                        </p>
                    </div>

                    <div class="p-5 rounded-3xl bg-green-50 border border-green-100">
                        <div class="w-12 h-12 rounded-2xl bg-green-600 text-white flex items-center justify-center font-black mb-4">
                            4
                        </div>
                        <h4 class="font-black text-gray-900">Bimbingan</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Mahasiswa upload file dan menerima catatan revisi.
                        </p>
                    </div>
                </div>
            </div>

            {{-- RIWAYAT PENGAJUAN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">
                            Riwayat Pengajuan Judul
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Daftar judul skripsi yang pernah kamu ajukan.
                        </p>
                    </div>

                    <a href="{{ route('mahasiswa.pengajuan-judul.create') }}"
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-sm font-bold transition">
                        + Ajukan Judul Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-2xl overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm">No</th>
                                <th class="border px-4 py-3 text-left text-sm">Judul</th>
                                <th class="border px-4 py-3 text-left text-sm">Dosen Pembimbing</th>
                                <th class="border px-4 py-3 text-left text-sm">Status</th>
                                <th class="border px-4 py-3 text-left text-sm">Catatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pengajuan as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm font-semibold text-gray-900">
                                        {{ $item->judul }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->dosen->nama ?? 'Belum ditentukan' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        @if ($item->status == 'disetujui')
                                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 font-bold">
                                                Disetujui
                                            </span>
                                        @elseif ($item->status == 'ditolak')
                                            <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700 font-bold">
                                                Ditolak
                                            </span>
                                        @elseif ($item->status == 'revisi')
                                            <span class="px-3 py-1 rounded-full text-xs bg-orange-100 text-orange-700 font-bold">
                                                Revisi
                                            </span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700 font-bold">
                                                Menunggu
                                            </span>
                                        @endif
                                    </td>

                                    <td class="border px-4 py-3 text-sm text-gray-600">
                                        {{ $item->catatan ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-8 text-center text-gray-500">
                                        Belum ada pengajuan judul.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                    <p class="text-sm text-blue-700">
                        Jika judul sudah berstatus <strong>Disetujui</strong>, kamu dapat melanjutkan ke menu
                        <strong>Bimbingan Skripsi</strong> untuk mengunggah file proposal atau BAB skripsi.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>