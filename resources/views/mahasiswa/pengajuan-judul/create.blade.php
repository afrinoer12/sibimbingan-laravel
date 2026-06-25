<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">
                Ajukan Judul Skripsi
            </h2>
            <p class="text-blue-100 text-sm mt-1">
                Isi data pengajuan judul skripsi dengan lengkap.
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                <div class="mb-7">
                    <h3 class="text-2xl font-black text-gray-900">
                        Form Pengajuan Judul
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Pastikan judul dan latar belakang sesuai dengan topik penelitian kamu.
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

                <form action="{{ route('mahasiswa.pengajuan-judul.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Judul Skripsi
                        </label>

                        <input type="text"
                               name="judul"
                               value="{{ old('judul') }}"
                               class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Contoh: Sistem Bimbingan Skripsi Online Berbasis Laravel"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Latar Belakang Singkat
                        </label>

                        <textarea name="latar_belakang"
                                  rows="7"
                                  class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Tuliskan latar belakang singkat dari judul yang diajukan">{{ old('latar_belakang') }}</textarea>
                    </div>

                    <div class="flex flex-col md:flex-row gap-3 pt-2">
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-sm shadow transition">
                            Simpan Pengajuan
                        </button>

                        <a href="{{ route('mahasiswa.pengajuan-judul.index') }}"
                           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-2xl font-bold text-sm transition text-center">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>