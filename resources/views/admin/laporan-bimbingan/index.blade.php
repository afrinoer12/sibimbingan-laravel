<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Laporan Bimbingan Skripsi
            </h2>
            <p class="text-sm text-gray-300 mt-1">
                Data seluruh riwayat bimbingan skripsi mahasiswa.
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-5">
                    <div>
                        <h3 class="font-bold text-lg text-gray-800">
                            Data Laporan Bimbingan
                        </h3>
                        <p class="text-sm text-gray-500">
                            Laporan ini dapat dicetak dalam bentuk PDF.
                        </p>
                    </div>

                    <a href="{{ route('admin.laporan-bimbingan.export-pdf') }}"
                       class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-semibold">
                        Export PDF
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm">No</th>
                                <th class="border px-4 py-3 text-left text-sm">Mahasiswa</th>
                                <th class="border px-4 py-3 text-left text-sm">Dosen</th>
                                <th class="border px-4 py-3 text-left text-sm">Judul</th>
                                <th class="border px-4 py-3 text-left text-sm">Tanggal</th>
                                <th class="border px-4 py-3 text-left text-sm">Topik</th>
                                <th class="border px-4 py-3 text-left text-sm">Status</th>
                                <th class="border px-4 py-3 text-left text-sm">Catatan Dosen</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bimbingan as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->mahasiswa->nama ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->dosen->nama ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->pengajuanJudul->judul ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->tanggal_bimbingan }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->topik_bimbingan }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ ucfirst($item->status) }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
                                        {{ $item->catatan_dosen ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border px-4 py-8 text-center text-gray-500">
                                        Belum ada data bimbingan.
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