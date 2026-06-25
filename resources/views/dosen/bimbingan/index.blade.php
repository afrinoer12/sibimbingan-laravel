<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">
                Data Bimbingan Mahasiswa
            </h2>
            <p class="text-blue-100 text-sm mt-1">
                Periksa file skripsi mahasiswa dan berikan catatan revisi.
            </p>
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

            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-blue-700 to-slate-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <h1 class="text-3xl font-black">
                        Pemeriksaan Bimbingan Skripsi
                    </h1>
                    <p class="text-blue-100 mt-2 max-w-2xl">
                        Semua data bimbingan mahasiswa yang berada di bawah dosen pembimbing akan tampil pada halaman ini.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-7">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500 font-semibold">Total</p>
                    <h2 class="text-3xl font-black text-gray-900 mt-2">
                        {{ $bimbingan->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500 font-semibold">Menunggu</p>
                    <h2 class="text-3xl font-black text-yellow-600 mt-2">
                        {{ $bimbingan->where('status', 'menunggu')->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500 font-semibold">Diproses</p>
                    <h2 class="text-3xl font-black text-blue-600 mt-2">
                        {{ $bimbingan->where('status', 'diproses')->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500 font-semibold">Revisi</p>
                    <h2 class="text-3xl font-black text-orange-600 mt-2">
                        {{ $bimbingan->where('status', 'revisi')->count() }}
                    </h2>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5">
                    <p class="text-sm text-gray-500 font-semibold">Disetujui</p>
                    <h2 class="text-3xl font-black text-green-600 mt-2">
                        {{ $bimbingan->where('status', 'disetujui')->count() }}
                    </h2>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-gray-900">
                        Daftar Bimbingan Mahasiswa
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Klik detail untuk melihat file dan memberikan catatan.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-2xl overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm">No</th>
                                <th class="border px-4 py-3 text-left text-sm">Mahasiswa</th>
                                <th class="border px-4 py-3 text-left text-sm">Tanggal</th>
                                <th class="border px-4 py-3 text-left text-sm">Judul</th>
                                <th class="border px-4 py-3 text-left text-sm">Topik</th>
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

                                    <td class="border px-4 py-3 text-sm font-bold text-gray-900">
                                        {{ $item->mahasiswa->nama ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ \Carbon\Carbon::parse($item->tanggal_bimbingan)->format('d M Y') }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm max-w-xs">
                                        {{ $item->pengajuanJudul->judul ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm text-gray-600">
                                        {{ $item->topik_bimbingan }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        @if ($item->status == 'disetujui')
                                            <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 font-bold">Disetujui</span>
                                        @elseif ($item->status == 'revisi')
                                            <span class="px-3 py-1 rounded-full text-xs bg-orange-100 text-orange-700 font-bold">Revisi</span>
                                        @elseif ($item->status == 'diproses')
                                            <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700 font-bold">Diproses</span>
                                        @elseif ($item->status == 'selesai')
                                            <span class="px-3 py-1 rounded-full text-xs bg-purple-100 text-purple-700 font-bold">Selesai</span>
                                        @else
                                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700 font-bold">Menunggu</span>
                                        @endif
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        <a href="{{ route('dosen.bimbingan.show', $item->id) }}"
                                           class="inline-flex px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition">
                                            Periksa
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border px-4 py-10 text-center text-gray-500">
                                        Belum ada data bimbingan mahasiswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>