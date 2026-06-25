<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">
                    Pemeriksaan Bimbingan
                </h2>
                <p class="text-blue-100 text-sm mt-1">
                    Periksa file skripsi dan berikan catatan revisi kepada mahasiswa.
                </p>
            </div>

            <a href="{{ route('dosen.bimbingan.index') }}"
               class="px-5 py-3 bg-white text-blue-700 rounded-2xl font-bold text-sm shadow hover:bg-blue-50 transition">
                Kembali
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

            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-blue-700 to-slate-900 rounded-3xl shadow-xl p-7 mb-7 text-white">
                <div class="absolute -top-24 -right-24 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <p class="text-blue-100 text-sm font-semibold">
                        Mahasiswa
                    </p>

                    <h1 class="text-3xl font-black mt-1">
                        {{ $bimbingan->mahasiswa->nama ?? '-' }}
                    </h1>

                    <p class="text-blue-100 mt-3 max-w-2xl">
                        {{ $bimbingan->pengajuanJudul->judul ?? '-' }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-7">

                {{-- KIRI --}}
                <div class="lg:col-span-2 space-y-7">

                    {{-- DETAIL BIMBINGAN --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-5">
                            Detail Bimbingan
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="p-5 rounded-3xl bg-blue-50 border border-blue-100">
                                <p class="text-sm font-bold text-blue-600">
                                    Topik Bimbingan
                                </p>
                                <p class="text-gray-900 font-black mt-1">
                                    {{ $bimbingan->topik_bimbingan }}
                                </p>
                            </div>

                            <div class="p-5 rounded-3xl bg-indigo-50 border border-indigo-100">
                                <p class="text-sm font-bold text-indigo-600">
                                    Tanggal
                                </p>
                                <p class="text-gray-900 font-black mt-1">
                                    {{ \Carbon\Carbon::parse($bimbingan->tanggal_bimbingan)->format('d M Y') }}
                                </p>
                            </div>

                            <div class="p-5 rounded-3xl bg-green-50 border border-green-100">
                                <p class="text-sm font-bold text-green-600">
                                    Mahasiswa
                                </p>
                                <p class="text-gray-900 font-black mt-1">
                                    {{ $bimbingan->mahasiswa->nama ?? '-' }}
                                </p>
                            </div>

                            <div class="p-5 rounded-3xl bg-yellow-50 border border-yellow-100">
                                <p class="text-sm font-bold text-yellow-600">
                                    Status Saat Ini
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
                        </div>
                    </div>

                    {{-- CATATAN MAHASISWA --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-4">
                            Catatan Mahasiswa
                        </h3>

                        <div class="p-5 rounded-3xl bg-gray-50 border border-gray-100">
                            <p class="text-sm text-gray-700 leading-relaxed">
                                {{ $bimbingan->catatan_mahasiswa ?? 'Tidak ada catatan mahasiswa.' }}
                            </p>
                        </div>
                    </div>

                    {{-- FILE SKRIPSI --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                        <h3 class="text-xl font-black text-gray-900 mb-5">
                            File Skripsi Mahasiswa
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @forelse ($bimbingan->fileSkripsi ?? [] as $file)
                                <div class="p-5 rounded-3xl bg-gray-50 border border-gray-100">
                                    <p class="font-black text-gray-900">
                                        {{ $file->nama_file }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1 uppercase">
                                        {{ str_replace('_', ' ', $file->jenis_file) }}
                                    </p>

                                    <div class="mt-4">
                                        @if (Route::has('file-skripsi.lihat'))
                                            <a href="{{ route('file-skripsi.lihat', $file->id) }}"
                                               target="_blank"
                                               class="inline-flex px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition">
                                                Lihat File
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $file->file_path) }}"
                                               target="_blank"
                                               class="inline-flex px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition">
                                                Lihat File
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="md:col-span-2 p-5 rounded-3xl bg-yellow-50 border border-yellow-100 text-center">
                                    <p class="text-sm text-yellow-700">
                                        Mahasiswa belum mengunggah file.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- RIWAYAT CATATAN --}}
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
                                        Belum ada catatan revisi.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- KANAN --}}
                <div class="space-y-7">

                    {{-- FORM UPDATE --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7 sticky top-28">
                        <h3 class="text-xl font-black text-gray-900 mb-2">
                            Update Bimbingan
                        </h3>

                        <p class="text-sm text-gray-500 mb-6">
                            Berikan status dan catatan kepada mahasiswa.
                        </p>

                        @if ($errors->any())
                            <div class="mb-5 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl">
                                <ul class="list-disc ml-5 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('dosen.bimbingan.update', $bimbingan->id) }}"
                              method="POST"
                              class="space-y-5">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    Status Bimbingan
                                </label>

                                <select name="status"
                                        class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="menunggu" {{ $bimbingan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diproses" {{ $bimbingan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="revisi" {{ $bimbingan->status == 'revisi' ? 'selected' : '' }}>Revisi</option>
                                    <option value="selesai" {{ $bimbingan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="disetujui" {{ $bimbingan->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">
                                    Catatan Dosen
                                </label>

                                <textarea name="catatan_dosen"
                                          rows="7"
                                          class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          placeholder="Tuliskan catatan revisi atau arahan untuk mahasiswa">{{ old('catatan_dosen', $bimbingan->catatan_dosen) }}</textarea>
                            </div>

                            <button type="submit"
                                    class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-sm shadow transition">
                                Simpan Catatan
                            </button>
                        </form>
                    </div>

                    {{-- INFO --}}
                    <div class="bg-gradient-to-br from-indigo-600 to-slate-900 rounded-3xl shadow-xl p-7 text-white">
                        <h3 class="text-xl font-black mb-3">
                            Panduan Status
                        </h3>

                        <div class="space-y-3 text-sm text-blue-100">
                            <p><strong class="text-white">Diproses:</strong> file sedang diperiksa.</p>
                            <p><strong class="text-white">Revisi:</strong> mahasiswa perlu memperbaiki file.</p>
                            <p><strong class="text-white">Selesai:</strong> bimbingan pada tahap ini selesai.</p>
                            <p><strong class="text-white">Disetujui:</strong> file dinyatakan diterima.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>