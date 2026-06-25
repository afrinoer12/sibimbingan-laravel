<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Dashboard Admin
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Kelola data bimbingan skripsi mahasiswa secara terpusat.
                </p>
            </div>

            <div class="px-4 py-2 bg-white/10 border border-white/20 rounded-2xl text-sm text-white">
                {{ now()->format('d M Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- WELCOME CARD --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-700 to-slate-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-cyan-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="text-blue-100 text-sm font-semibold">
                            Selamat Datang
                        </p>

                        <h1 class="text-3xl font-black mt-1">
                            {{ auth()->user()->name }}
                        </h1>

                        <p class="text-blue-100 mt-3 max-w-2xl">
                            Pantau pengajuan judul, dosen pembimbing, proses bimbingan, dan laporan skripsi mahasiswa dalam satu sistem.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.pengajuan-judul.index') }}"
                           class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                            Kelola Pengajuan
                        </a>

                        @if (Route::has('admin.laporan-bimbingan.index'))
                            <a href="{{ route('admin.laporan-bimbingan.index') }}"
                               class="px-5 py-3 bg-red-500 text-white rounded-2xl font-bold text-sm shadow hover:bg-red-600 transition">
                                Laporan Bimbingan
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-7">

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Total Mahasiswa</p>
                            <h2 class="text-4xl font-black text-gray-900 mt-2">
                                {{ $totalMahasiswa ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-black">
                            M
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Total Dosen</p>
                            <h2 class="text-4xl font-black text-gray-900 mt-2">
                                {{ $totalDosen ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-black">
                            D
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Pengajuan Judul</p>
                            <h2 class="text-4xl font-black text-gray-900 mt-2">
                                {{ $totalPengajuan ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-2xl font-black">
                            J
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold">Total Bimbingan</p>
                            <h2 class="text-4xl font-black text-gray-900 mt-2">
                                {{ $totalBimbingan ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-2xl font-black">
                            B
                        </div>
                    </div>
                </div>

            </div>

            {{-- MENU ADMIN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <a href="{{ route('admin.pengajuan-judul.index') }}"
                   class="group bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl font-black mb-5 group-hover:scale-110 transition">
                        01
                    </div>

                    <h3 class="text-lg font-black text-gray-900">
                        Pengajuan Judul
                    </h3>

                    <p class="text-gray-500 text-sm mt-2">
                        Kelola pengajuan judul skripsi mahasiswa dan tentukan dosen pembimbing.
                    </p>
                </a>

                <a href="#"
                   class="group bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl font-black mb-5 group-hover:scale-110 transition">
                        02
                    </div>

                    <h3 class="text-lg font-black text-gray-900">
                        Data Pengguna
                    </h3>

                    <p class="text-gray-500 text-sm mt-2">
                        Kelola data mahasiswa, dosen, dan akun pengguna sistem.
                    </p>
                </a>

                @if (Route::has('admin.laporan-bimbingan.index'))
                    <a href="{{ route('admin.laporan-bimbingan.index') }}"
                       class="group bg-white rounded-3xl shadow-sm border border-gray-100 p-6 hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="w-14 h-14 rounded-2xl bg-red-600 text-white flex items-center justify-center text-xl font-black mb-5 group-hover:scale-110 transition">
                            03
                        </div>

                        <h3 class="text-lg font-black text-gray-900">
                            Laporan Bimbingan
                        </h3>

                        <p class="text-gray-500 text-sm mt-2">
                            Lihat dan cetak laporan riwayat bimbingan skripsi mahasiswa.
                        </p>
                    </a>
                @else
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 opacity-70">
                        <div class="w-14 h-14 rounded-2xl bg-gray-400 text-white flex items-center justify-center text-xl font-black mb-5">
                            03
                        </div>

                        <h3 class="text-lg font-black text-gray-900">
                            Laporan Bimbingan
                        </h3>

                        <p class="text-gray-500 text-sm mt-2">
                            Route laporan belum tersedia.
                        </p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>