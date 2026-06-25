<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">
                Pengajuan Judul Mahasiswa
            </h2>
            <p class="text-blue-100 text-sm mt-1">
                Periksa dan berikan keputusan terhadap judul mahasiswa.
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
                        Daftar Pengajuan Judul
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Berikan status disetujui, revisi, atau ditolak.
                    </p>
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

                                    <td class="border px-4 py-3 text-sm max-w-xs">
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

                                    <td class="border px-4 py-3 text-sm min-w-[260px]">
                                        <form action="{{ route('dosen.pengajuan-judul.status', $item->id) }}"
                                              method="POST"
                                              class="space-y-3">
                                            @csrf
                                            @method('PUT')

                                            <select name="status"
                                                    class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                    required>
                                                <option value="">Pilih Status</option>
                                                <option value="disetujui">Disetujui</option>
                                                <option value="ditolak">Ditolak</option>
                                                <option value="revisi">Revisi</option>
                                            </select>

                                            <textarea name="catatan"
                                                      class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                      rows="2"
                                                      placeholder="Catatan dosen"></textarea>

                                            <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition">
                                                Simpan Keputusan
                                            </button>
                                        </form>
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

                <div class="mt-6 p-4 bg-green-50 border border-green-100 rounded-2xl">
                    <p class="text-sm text-green-700">
                        Setelah judul disetujui, mahasiswa dapat melanjutkan proses bimbingan skripsi dan mengunggah file.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>