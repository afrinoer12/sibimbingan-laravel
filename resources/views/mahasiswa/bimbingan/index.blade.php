<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Bimbingan Skripsi
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Kelola pengajuan bimbingan dan pantau catatan revisi dosen.
                </p>
            </div>

            <a href="{{ route('mahasiswa.bimbingan.create') }}"
               class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                + Ajukan Bimbingan
            </a>
        </div>
    </x-slot>

    @php
        $bimbingan = $bimbingan ?? collect();
    @endphp

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-blue-700 to-indigo-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <h1 class="text-3xl font-black">
                            Riwayat Bimbingan Skripsi
                        </h1>
                        <p class="text-blue-100 mt-2 max-w-2xl">
                            Upload file skripsi, lihat status pemeriksaan, dan baca catatan revisi dari dosen pembimbing.
                        </p>
                    </div>

                    <a href="{{ route('mahasiswa.bimbingan.create') }}"
                       class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                        Ajukan Bimbingan Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-7">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500 font-semibold">Total Bimbingan</p>
                    <h2 class="text-4xl font-black text-gray-900 mt-2">
                        {{ $bimbingan->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500 font-semibold">Menunggu</p>
                    <h2 class="text-4xl font-black text-yellow-600 mt-2">
                        {{ $bimbingan->where('status', 'menunggu')->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500 font-semibold">Revisi</p>
                    <h2 class="text-4xl font-black text-orange-600 mt-2">
                        {{ $bimbingan->where('status', 'revisi')->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <p class="text-sm text-gray-500 font-semibold">Disetujui</p>
                    <h2 class="text-4xl font-black text-green-600 mt-2">
                        {{ $bimbingan->where('status', 'disetujui')->count() }}
                    </h2>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-gray-900">
                        Data Bimbingan
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Daftar bimbingan yang sudah kamu ajukan.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-2xl overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm">No</th>
                                <th class="border px-4 py-3 text-left text-sm">Tanggal</th>
                                <th class="border px-4 py-3 text-left text-sm">Judul</th>
                                <th class="border px-4 py-3 text-left text-sm">Topik</th>
                                <th class="border px-4 py-3 text-left text-sm">Dosen</th>
                                <th class="border px-4 py-3 text-left text-sm">Status</th>
                                <th class="border px-4 py-3 text-left text-sm">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bimbingan as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ \Carbon\Carbon::parse($item->tanggal_bimbingan)->format('d M Y') }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm font-bold text-gray-900 max-w-xs">
                                        {{ $item->pengajuanJudul->judul ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm text-gray-600">
                                        {{ $item->topik_bimbingan }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->dosen->nama ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        @if ($item->status == 'disetujui')
                                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 font-bold">Disetujui</span>
                                        @elseif ($item->status == 'revisi')
                                            <span class="px-3 py-1 rounded-full text-xs bg-orange-100 text-orange-700 font-bold">Revisi</span>
                                        @elseif ($item->status == 'diproses')
                                            <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700 font-bold">Diproses</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700 font-bold">Menunggu</span>
                                        @endif
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        <a href="{{ route('mahasiswa.bimbingan.show', $item->id) }}"
                                           class="inline-flex px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border px-4 py-10 text-center text-gray-500">
                                        Belum ada data bimbingan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                    <p class="text-sm text-blue-700">
                        Bimbingan dapat diajukan setelah judul skripsi kamu berstatus <strong>Disetujui</strong>.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>