<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Detail Bimbingan Skripsi
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Lihat detail file, status, dan catatan revisi dari dosen pembimbing.
                </p>
            </div>

            <a href="{{ route('mahasiswa.bimbingan.index') }}"
               class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HERO DETAIL --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-blue-700 to-indigo-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <p class="text-emerald-100 text-sm font-semibold">
                        Topik Bimbingan
                    </p>

                    <h1 class="text-3xl font-black mt-1">
                        {{ $bimbingan->topik_bimbingan }}
                    </h1>

                    <p class="text-blue-100 mt-3">
                        Tanggal bimbingan:
                        <strong>
                            {{ \Carbon\Carbon::parse($bimbingan->tanggal_bimbingan)->format('d M Y') }}
                        </strong>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">

                {{-- KIRI --}}
                <div class="lg:col-span-2 space-y-7">

                    {{-- INFORMASI BIMBINGAN --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-5">
                            Informasi Bimbingan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="p-5 rounded-3xl bg-blue-50 border border-blue-100">
                                <p class="text-sm font-bold text-blue-600">
                                    Judul Skripsi
                                </p>
                                <p class="text-gray-900 font-black mt-1">
                                    {{ $bimbingan->pengajuanJudul->judul ?? '-' }}
                                </p>
                            </div>

                            <div class="p-5 rounded-3xl bg-indigo-50 border border-indigo-100">
                                <p class="text-sm font-bold text-indigo-600">
                                    Dosen Pembimbing
                                </p>
                                <p class="text-gray-900 font-black mt-1">
                                    {{ $bimbingan->dosen->nama ?? '-' }}
                                </p>
                            </div>

                            <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100">
                                <p class="text-sm font-bold text-yellow-600">
                                    Status
                                </p>

                                <div class="mt-2">
                                    @if ($bimbingan->status == 'disetujui')
                                        <span class="px-4 py-2 rounded-full text-xs bg-green-100 text-green-700 font-bold">
                                            Disetujui
                                        </span>
                                    @elseif ($bimbingan->status == 'revisi')
                                        <span class="px-4 py-2 rounded-full text-xs bg-orange-100 text-orange-700 font-bold">
                                            Revisi
                                        </span>
                                    @elseif ($bimbingan->status == 'diproses')
                                        <span class="px-4 py-2 rounded-full text-xs bg-blue-100 text-blue-700 font-bold">
                                            Diproses
                                        </span>
                                    @elseif ($bimbingan->status == 'selesai')
                                        <span class="px-4 py-2 rounded-full text-xs bg-purple-100 text-purple-700 font-bold">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="px-4 py-2 rounded-full text-xs bg-yellow-100 text-yellow-700 font-bold">
                                            Menunggu
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-5 rounded-3xl bg-green-50 border border-green-100">
                                <p class="text-sm font-bold text-green-600">
                                    Tanggal
                                </p>
                                <p class="text-gray-900 font-black mt-1">
                                    {{ \Carbon\Carbon::parse($bimbingan->tanggal_bimbingan)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- CATATAN MAHASISWA --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-4">
                            Catatan Mahasiswa
                        </h3>

                        <div class="p-5 rounded-3xl bg-gray-50 border border-gray-100">
                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ $bimbingan->catatan_mahasiswa ?? 'Tidak ada catatan dari mahasiswa.' }}
                            </p>
                        </div>
                    </div>

                    {{-- CATATAN DOSEN --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-4">
                            Catatan Dosen
                        </h3>

                        @if ($bimbingan->catatan_dosen)
                            <div class="p-5 rounded-3xl bg-blue-50 border border-blue-100">
                                <p class="text-sm text-blue-800 leading-relaxed">
                                    {{ $bimbingan->catatan_dosen }}
                                </p>
                            </div>
                        @else
                            <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100">
                                <p class="text-sm text-yellow-700">
                                    Dosen belum memberikan catatan.
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- RIWAYAT CATATAN REVISI --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-5">
                            Riwayat Catatan Revisi
                        </h3>

                        <div class="space-y-4">
                            @forelse ($bimbingan->catatanRevisi ?? [] as $revisi)
                                <div class="p-5 rounded-3xl bg-orange-50 border border-orange-100">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-2">
                                        <p class="font-black text-orange-800">
                                            {{ $revisi->dosen->nama ?? 'Dosen Pembimbing' }}
                                        </p>

                                        <span class="text-xs text-orange-600 font-bold">
                                            {{ $revisi->created_at ? $revisi->created_at->format('d M Y H:i') : '-' }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        {{ $revisi->catatan }}
                                    </p>
                                </div>
                            @empty
                                <div class="p-5 rounded-3xl bg-gray-50 border border-gray-100 text-center">
                                    <p class="text-sm text-gray-500">
                                        Belum ada riwayat catatan revisi.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- KANAN --}}
                <div class="space-y-7">

                    {{-- FILE SKRIPSI --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-5">
                            File Skripsi
                        </h3>

                        <div class="space-y-4">
                            @forelse ($bimbingan->fileSkripsi ?? [] as $file)
                                <div class="p-5 rounded-3xl bg-gray-50 border border-gray-100">
                                    <p class="font-black text-gray-900">
                                        {{ $file->nama_file }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1 uppercase">
                                        {{ str_replace('_', ' ', $file->jenis_file) }}
                                    </p>

                                    <div class="mt-4 flex flex-col gap-2">
                                        @if (Route::has('file-skripsi.lihat'))
                                            <a href="{{ route('file-skripsi.lihat', $file->id) }}"
                                               target="_blank"
                                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold text-center transition">
                                                Lihat File
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $file->file_path) }}"
                                               target="_blank"
                                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold text-center transition">
                                                Lihat File
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100 text-center">
                                    <p class="text-sm text-yellow-700">
                                        Belum ada file yang diunggah.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-800 rounded-3xl shadow-xl p-7 text-white">
                        <h3 class="text-xl font-black mb-3">
                            Informasi
                        </h3>

                        <p class="text-sm text-blue-100 leading-relaxed">
                            Periksa catatan dosen secara berkala. Jika status bimbingan menjadi revisi, lakukan perbaikan file dan ajukan bimbingan kembali.
                        </p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>