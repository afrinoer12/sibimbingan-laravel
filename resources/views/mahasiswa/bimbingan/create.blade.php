<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">
                Ajukan Bimbingan Skripsi
            </h2>
            <p class="text-blue-100 text-sm mt-1">
                Upload file skripsi dan jelaskan topik bimbingan.
            </p>
        </div>
    </x-slot>

    @php
        $pengajuanList = $pengajuanDisetujui ?? $pengajuan ?? collect();
    @endphp

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                <div class="mb-7">
                    <h3 class="text-2xl font-black text-gray-900">
                        Form Bimbingan Skripsi
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Pilih judul yang sudah disetujui, lalu upload file skripsi kamu.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl">
                        <ul class="list-disc ml-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($pengajuanList->count() == 0)
                    <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-3xl">
                        <h4 class="font-black text-yellow-800">
                            Belum Ada Judul yang Disetujui
                        </h4>
                        <p class="text-sm text-yellow-700 mt-2">
                            Kamu belum bisa mengajukan bimbingan karena belum ada judul skripsi yang disetujui.
                        </p>

                        <a href="{{ route('mahasiswa.pengajuan-judul.index') }}"
                           class="inline-flex mt-4 px-5 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-2xl text-sm font-bold transition">
                            Lihat Pengajuan Judul
                        </a>
                    </div>
                @else
                    <form action="{{ route('mahasiswa.bimbingan.store') }}"
                          method="POST"
                          enctype="multipart/form-data"
                          class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Judul Skripsi
                            </label>

                            <select name="pengajuan_judul_id"
                                    class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">-- Pilih Judul Skripsi --</option>

                                @foreach ($pengajuanList as $item)
                                    <option value="{{ $item->id }}" {{ old('pengajuan_judul_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Tanggal Bimbingan
                            </label>

                            <input type="date"
                                   name="tanggal_bimbingan"
                                   value="{{ old('tanggal_bimbingan', date('Y-m-d')) }}"
                                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Topik Bimbingan
                            </label>

                            <input type="text"
                                   name="topik_bimbingan"
                                   value="{{ old('topik_bimbingan') }}"
                                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   placeholder="Contoh: Revisi BAB I / Pengajuan Proposal / BAB II"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Catatan Mahasiswa
                            </label>

                            <textarea name="catatan_mahasiswa"
                                      rows="5"
                                      class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      placeholder="Tuliskan hal yang ingin dikonsultasikan kepada dosen">{{ old('catatan_mahasiswa') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Jenis File
                            </label>

                            <select name="jenis_file"
                                    class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                <option value="">-- Pilih Jenis File --</option>
                                <option value="proposal" {{ old('jenis_file') == 'proposal' ? 'selected' : '' }}>Proposal</option>
                                <option value="bab_1" {{ old('jenis_file') == 'bab_1' ? 'selected' : '' }}>BAB I</option>
                                <option value="bab_2" {{ old('jenis_file') == 'bab_2' ? 'selected' : '' }}>BAB II</option>
                                <option value="bab_3" {{ old('jenis_file') == 'bab_3' ? 'selected' : '' }}>BAB III</option>
                                <option value="bab_4" {{ old('jenis_file') == 'bab_4' ? 'selected' : '' }}>BAB IV</option>
                                <option value="bab_5" {{ old('jenis_file') == 'bab_5' ? 'selected' : '' }}>BAB V</option>
                                <option value="full_skripsi" {{ old('jenis_file') == 'full_skripsi' ? 'selected' : '' }}>Full Skripsi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Upload File Skripsi
                            </label>

                            <input type="file"
                                   name="file_skripsi"
                                   class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   accept=".pdf,.doc,.docx"
                                   required>

                            <p class="text-xs text-gray-500 mt-2">
                                Format file: PDF, DOC, atau DOCX. Maksimal 5MB.
                            </p>
                        </div>

                        <div class="flex flex-col md:flex-row gap-3 pt-2">
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-sm shadow transition">
                                Kirim Bimbingan
                            </button>

                            <a href="{{ route('mahasiswa.bimbingan.index') }}"
                               class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-2xl font-bold text-sm transition text-center">
                                Kembali
                            </a>
                        </div>
                    </form>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>