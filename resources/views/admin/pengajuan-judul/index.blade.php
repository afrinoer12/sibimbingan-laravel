<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">
                Kelola Pengajuan Judul
            </h2>
            <p class="text-blue-100 text-sm mt-1">
                Tentukan dosen pembimbing untuk pengajuan judul mahasiswa.
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="mb-6">
                    <h3 class="text-xl font-black text-gray-900">
                        Data Pengajuan Judul Mahasiswa
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Admin dapat menetapkan dosen pembimbing untuk setiap pengajuan.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 rounded-2xl overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-3 text-left text-sm">No</th>
                                <th class="border px-4 py-3 text-left text-sm">Mahasiswa</th>
                                <th class="border px-4 py-3 text-left text-sm">Judul</th>
                                <th class="border px-4 py-3 text-left text-sm">Dosen Pembimbing</th>
                                <th class="border px-4 py-3 text-left text-sm">Status</th>
                                <th class="border px-4 py-3 text-left text-sm">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pengajuan as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm font-bold text-gray-900">
                                        {{ $item->mahasiswa->nama ?? '-' }}
                                    </td>

                                    <td class="border px-4 py-3 text-sm">
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

                                    <td class="border px-4 py-3 text-sm">
                                        <a href="{{ route('admin.pengajuan-judul.edit', $item->id) }}"
                                           class="inline-flex px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition">
                                            Tentukan Dosen
                                        </a>
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

            </div>

        </div>
    </div>
</x-app-layout>