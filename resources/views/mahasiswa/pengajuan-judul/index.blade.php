<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Pengajuan Judul Skripsi
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Ajukan dan pantau status judul skripsi kamu.
                </p>
            </div>

            <a href="{{ route('mahasiswa.pengajuan-judul.create') }}"
               class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                + Ajukan Judul
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-700 to-slate-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h1 class="text-3xl font-black">
                        Data Pengajuan Judul
                    </h1>
                    <p class="text-blue-100 mt-2 max-w-2xl">
                        Setelah judul diajukan, admin akan menentukan dosen pembimbing. Selanjutnya dosen akan memberikan keputusan terhadap judul tersebut.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
                    <div>
                        <h3 class="text-xl font-black text-gray-900">
                            Riwayat Pengajuan
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Daftar judul skripsi yang sudah kamu ajukan.
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
                                <th class="border px-4 py-3 text-left text-sm">Latar Belakang</th>
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

                                    <td class="border px-4 py-3 text-sm font-bold text-gray-900">
                                        {{ $item->judul }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm text-gray-600 max-w-xs">
                                        {{ Str::limit($item->latar_belakang ?? '-', 100) }}
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
                                    <td colspan="6" class="border px-4 py-10 text-center text-gray-500">
                                        Belum ada pengajuan judul.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                    <p class="text-sm text-blue-700">
                        Judul yang sudah <strong>disetujui</strong> dapat digunakan untuk melanjutkan proses bimbingan skripsi.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>