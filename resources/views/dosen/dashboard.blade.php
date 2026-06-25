<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Dashboard Dosen
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Periksa pengajuan judul, file skripsi, dan berikan catatan revisi.
                </p>
            </div>

            <div class="px-4 py-2 bg-white/10 border border-white/20 rounded-2xl text-sm text-white">
                {{ now()->format('d M Y') }}
            </div>
        </div>
    </x-slot>

    @php
        $pengajuan = $pengajuan ?? collect();

        $totalBimbingan = $totalBimbingan ?? 0;
        $bimbinganMenunggu = $bimbinganMenunggu ?? 0;
        $bimbinganDiproses = $bimbinganDiproses ?? 0;
        $bimbinganRevisi = $bimbinganRevisi ?? 0;
        $bimbinganDisetujui = $bimbinganDisetujui ?? 0;

        $totalKategoriUtama = $bimbinganMenunggu + $bimbinganDiproses + $bimbinganRevisi + $bimbinganDisetujui;
        $bimbinganLainnya = max($totalBimbingan - $totalKategoriUtama, 0);

        $totalGrafik = $totalBimbingan > 0 ? $totalBimbingan : 1;

        $persenMenunggu = round(($bimbinganMenunggu / $totalGrafik) * 100);
        $persenDiproses = round(($bimbinganDiproses / $totalGrafik) * 100);
        $persenRevisi = round(($bimbinganRevisi / $totalGrafik) * 100);
        $persenDisetujui = round(($bimbinganDisetujui / $totalGrafik) * 100);
        $persenLainnya = round(($bimbinganLainnya / $totalGrafik) * 100);

        $getBarClass = function ($persen) {
            if ($persen <= 0) {
                return 'w-0';
            } elseif ($persen <= 10) {
                return 'w-1/12';
            } elseif ($persen <= 20) {
                return 'w-1/5';
            } elseif ($persen <= 30) {
                return 'w-1/3';
            } elseif ($persen <= 40) {
                return 'w-2/5';
            } elseif ($persen <= 50) {
                return 'w-1/2';
            } elseif ($persen <= 60) {
                return 'w-3/5';
            } elseif ($persen <= 70) {
                return 'w-2/3';
            } elseif ($persen <= 80) {
                return 'w-4/5';
            } elseif ($persen <= 90) {
                return 'w-11/12';
            }

            return 'w-full';
        };

        $dataGrafikBimbingan = collect([
            [
                'label' => 'Menunggu',
                'jumlah' => $bimbinganMenunggu,
                'persen' => $persenMenunggu,
                'bar' => $getBarClass($persenMenunggu),
                'warna' => 'bg-yellow-500',
                'teks' => 'text-yellow-700',
                'keterangan' => 'Bimbingan yang belum diperiksa oleh dosen.',
            ],
            [
                'label' => 'Diproses',
                'jumlah' => $bimbinganDiproses,
                'persen' => $persenDiproses,
                'bar' => $getBarClass($persenDiproses),
                'warna' => 'bg-blue-500',
                'teks' => 'text-blue-700',
                'keterangan' => 'Bimbingan yang sedang dalam tahap pemeriksaan.',
            ],
            [
                'label' => 'Revisi',
                'jumlah' => $bimbinganRevisi,
                'persen' => $persenRevisi,
                'bar' => $getBarClass($persenRevisi),
                'warna' => 'bg-orange-500',
                'teks' => 'text-orange-700',
                'keterangan' => 'Bimbingan yang membutuhkan perbaikan dari mahasiswa.',
            ],
            [
                'label' => 'Disetujui',
                'jumlah' => $bimbinganDisetujui,
                'persen' => $persenDisetujui,
                'bar' => $getBarClass($persenDisetujui),
                'warna' => 'bg-green-600',
                'teks' => 'text-green-700',
                'keterangan' => 'Bimbingan yang sudah dinyatakan sesuai oleh dosen.',
            ],
            [
                'label' => 'Selesai / Lainnya',
                'jumlah' => $bimbinganLainnya,
                'persen' => $persenLainnya,
                'bar' => $getBarClass($persenLainnya),
                'warna' => 'bg-slate-500',
                'teks' => 'text-slate-700',
                'keterangan' => 'Bimbingan dengan status selain kategori utama.',
            ],
        ]);

        $statusTerbanyak = $dataGrafikBimbingan->sortByDesc('jumlah')->first();
        $jumlahPerluPerhatian = $bimbinganMenunggu + $bimbinganDiproses + $bimbinganRevisi;
    @endphp

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HERO CARD --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-blue-700 to-slate-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 text-sm font-semibold">
                            Selamat Datang
                        </p>

                        <h1 class="text-3xl font-black mt-1">
                            {{ auth()->user()->name }}
                        </h1>

                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Kelola mahasiswa bimbingan, periksa pengajuan judul, tinjau file skripsi, dan berikan arahan revisi secara online.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('dosen.pengajuan-judul.index') }}"
                           class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                            Pengajuan Judul
                        </a>

                        <a href="{{ route('dosen.bimbingan.index') }}"
                           class="px-5 py-3 bg-emerald-500 text-white rounded-2xl font-bold text-sm shadow hover:bg-emerald-600 transition">
                            Data Bimbingan
                        </a>
                    </div>
                </div>
            </div>

            {{-- STATISTIK PENGAJUAN --}}
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

            {{-- GRAFIK BIMBINGAN --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-7 mb-7">

                {{-- GRAFIK STATUS --}}
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-7">
                        <div>
                            <h3 class="text-xl font-black text-gray-900">
                                Grafik Status Bimbingan
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Visualisasi status bimbingan mahasiswa berdasarkan proses pemeriksaan dosen.
                            </p>
                        </div>

                        <div class="px-5 py-3 rounded-2xl bg-indigo-50 border border-indigo-100">
                            <p class="text-xs font-bold text-indigo-600">
                                Total Bimbingan
                            </p>
                            <h2 class="text-3xl font-black text-indigo-700">
                                {{ $totalBimbingan }}
                            </h2>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @foreach ($dataGrafikBimbingan as $data)
                            @if ($data['jumlah'] > 0 || $data['label'] !== 'Selesai / Lainnya')
                                <div>
                                    <div class="flex items-center justify-between gap-4 mb-2">
                                        <div>
                                            <p class="text-sm font-black text-gray-900">
                                                {{ $data['label'] }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $data['keterangan'] }}
                                            </p>
                                        </div>

                                        <div class="text-right min-w-[80px]">
                                            <p class="text-sm font-black {{ $data['teks'] }}">
                                                {{ $data['jumlah'] }} Data
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $totalBimbingan > 0 ? $data['persen'] : 0 }}%
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full h-4 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="{{ $data['warna'] }} {{ $data['bar'] }} h-4 rounded-full transition-all duration-700"></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- RINGKASAN --}}
                <div class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-3xl shadow-xl p-7 text-white">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center mb-5">
                        <span class="text-2xl font-black">📊</span>
                    </div>

                    <h3 class="text-xl font-black mb-3">
                        Analisis Bimbingan
                    </h3>

                    @if ($totalBimbingan == 0)
                        <p class="text-sm text-blue-100 leading-relaxed">
                            Belum ada data bimbingan yang masuk. Grafik akan otomatis berubah ketika mahasiswa mulai mengajukan bimbingan.
                        </p>
                    @else
                        <p class="text-sm text-blue-100 leading-relaxed">
                            Saat ini terdapat
                            <strong class="text-white">{{ $totalBimbingan }}</strong>
                            data bimbingan. Status yang paling dominan adalah
                            <strong class="text-white">{{ $statusTerbanyak['label'] }}</strong>
                            dengan jumlah
                            <strong class="text-white">{{ $statusTerbanyak['jumlah'] }}</strong>
                            data.
                        </p>

                        <div class="mt-5 space-y-3">
                            <div class="p-4 rounded-2xl bg-white/10 border border-white/10">
                                <p class="text-xs text-blue-100">
                                    Tingkat persetujuan bimbingan
                                </p>
                                <h4 class="text-2xl font-black text-white mt-1">
                                    {{ $persenDisetujui }}%
                                </h4>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/10 border border-white/10">
                                <p class="text-xs text-blue-100">
                                    Bimbingan yang perlu perhatian
                                </p>
                                <h4 class="text-2xl font-black text-white mt-1">
                                    {{ $jumlahPerluPerhatian }}
                                </h4>
                            </div>
                        </div>

                        @if ($bimbinganDisetujui > 0 && $jumlahPerluPerhatian == 0)
                            <p class="text-xs text-blue-100 mt-5 leading-relaxed">
                                Kondisi bimbingan cukup baik karena tidak ada data yang menunggu, diproses, atau revisi.
                            </p>
                        @elseif ($jumlahPerluPerhatian > 0)
                            <p class="text-xs text-blue-100 mt-5 leading-relaxed">
                                Prioritaskan data berstatus menunggu, diproses, atau revisi agar proses bimbingan mahasiswa tetap berjalan lancar.
                            </p>
                        @else
                            <p class="text-xs text-blue-100 mt-5 leading-relaxed">
                                Grafik ini membantu dosen melihat perkembangan bimbingan tanpa membaca angka satu per satu.
                            </p>
                        @endif
                    @endif
                </div>

            </div>

            {{-- ALUR DOSEN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7 mb-7">
                <h3 class="text-xl font-black text-gray-900 mb-5">
                    Alur Kerja Dosen Pembimbing
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="p-5 rounded-3xl bg-blue-50 border border-blue-100">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-black mb-4">
                            1
                        </div>
                        <h4 class="font-black text-gray-900">Periksa Judul</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Dosen melihat daftar judul mahasiswa bimbingan.
                        </p>
                    </div>

                    <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100">
                        <div class="w-12 h-12 rounded-2xl bg-yellow-500 text-white flex items-center justify-center font-black mb-4">
                            2
                        </div>
                        <h4 class="font-black text-gray-900">Beri Keputusan</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Judul dapat disetujui, ditolak, atau diminta revisi.
                        </p>
                    </div>

                    <div class="p-5 rounded-3xl bg-green-50 border border-green-100">
                        <div class="w-12 h-12 rounded-2xl bg-green-600 text-white flex items-center justify-center font-black mb-4">
                            3
                        </div>
                        <h4 class="font-black text-gray-900">Periksa File</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Dosen membuka dan memeriksa file skripsi mahasiswa.
                        </p>
                    </div>

                    <div class="p-5 rounded-3xl bg-purple-50 border border-purple-100">
                        <div class="w-12 h-12 rounded-2xl bg-purple-600 text-white flex items-center justify-center font-black mb-4">
                            4
                        </div>
                        <h4 class="font-black text-gray-900">Catatan Revisi</h4>
                        <p class="text-sm text-gray-600 mt-2">
                            Dosen memberikan catatan revisi dan status bimbingan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- DAFTAR PENGAJUAN --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">
                            Daftar Pengajuan Judul Mahasiswa
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Data pengajuan judul yang sudah ditetapkan kepada dosen pembimbing.
                        </p>
                    </div>

                    <a href="{{ route('dosen.pengajuan-judul.index') }}"
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-sm font-bold transition">
                        Lihat Semua
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-2xl overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm">No</th>
                                <th class="border px-4 py-3 text-left text-sm">Mahasiswa</th>
                                <th class="border px-4 py-3 text-left text-sm">Judul</th>
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
                                        {{ $item->mahasiswa->nama ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->judul }}
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

                <div class="mt-5 p-4 bg-green-50 border border-green-100 rounded-2xl">
                    <p class="text-sm text-green-700">
                        Pengajuan judul hanya muncul jika admin sudah menentukan dosen pembimbing untuk mahasiswa tersebut.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
```
