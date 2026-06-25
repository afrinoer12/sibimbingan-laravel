<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">
                Tentukan Dosen Pembimbing
            </h2>
            <p class="text-blue-100 text-sm mt-1">
                Pilih dosen pembimbing untuk pengajuan judul mahasiswa.
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-7">
                    <div class="p-5 rounded-3xl bg-blue-50 border border-blue-100">
                        <p class="text-sm text-blue-600 font-bold">Mahasiswa</p>
                        <h3 class="text-lg font-black text-gray-900 mt-1">
                            {{ $pengajuan->mahasiswa->nama ?? '-' }}
                        </h3>
                    </div>

                    <div class="p-5 rounded-3xl bg-indigo-50 border border-indigo-100">
                        <p class="text-sm text-indigo-600 font-bold">Status</p>
                        <h3 class="text-lg font-black text-gray-900 mt-1 capitalize">
                            {{ $pengajuan->status }}
                        </h3>
                    </div>
                </div>

                <div class="mb-7 p-5 rounded-3xl bg-gray-50 border border-gray-100">
                    <p class="text-sm text-gray-500 font-bold">Judul Skripsi</p>
                    <h3 class="text-lg font-black text-gray-900 mt-1">
                        {{ $pengajuan->judul }}
                    </h3>
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

                <form action="{{ route('admin.pengajuan-judul.update', $pengajuan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Pilih Dosen Pembimbing
                        </label>

                        <select name="dosen_id"
                                class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            <option value="">-- Pilih Dosen --</option>

                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->id }}"
                                    {{ $pengajuan->dosen_id == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama }} - {{ $dosen->nidn }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col md:flex-row gap-3">
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold text-sm shadow transition">
                            Simpan Dosen Pembimbing
                        </button>

                        <a href="{{ route('admin.pengajuan-judul.index') }}"
                           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-2xl font-bold text-sm transition text-center">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>