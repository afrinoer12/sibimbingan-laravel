<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">
            Buat Akun Baru
        </h2>
        <p class="text-gray-500 text-sm mt-1">
            Registrasi akun mahasiswa atau dosen.
        </p>
    </div>

    @if ($errors->has('register'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-2xl text-sm">
            {{ $errors->first('register') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">
                Daftar Sebagai
            </label>

            <select id="role"
                    name="role"
                    required
                    onchange="toggleRoleFields()"
                    class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">-- Pilih Role --</option>
                <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                    Mahasiswa
                </option>
                <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>
                    Dosen
                </option>
            </select>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                Nama Lengkap
            </label>

            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   placeholder="Masukkan nama lengkap"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                Email
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   placeholder="Masukkan email"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- FIELD MAHASISWA --}}
        <div id="mahasiswa-fields" class="space-y-5 hidden">
            <div>
                <label for="nim" class="block text-sm font-semibold text-gray-700 mb-1">
                    NIM
                </label>

                <input id="nim"
                       type="text"
                       name="nim"
                       value="{{ old('nim') }}"
                       placeholder="Masukkan NIM"
                       class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>

            <div>
                <label for="prodi" class="block text-sm font-semibold text-gray-700 mb-1">
                    Program Studi
                </label>

                <input id="prodi"
                       type="text"
                       name="prodi"
                       value="{{ old('prodi', 'Teknik Informatika') }}"
                       placeholder="Contoh: Teknik Informatika"
                       class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <x-input-error :messages="$errors->get('prodi')" class="mt-2" />
            </div>
        </div>

        {{-- FIELD DOSEN --}}
        <div id="dosen-fields" class="space-y-5 hidden">
            <div>
                <label for="nidn" class="block text-sm font-semibold text-gray-700 mb-1">
                    NIDN
                </label>

                <input id="nidn"
                       type="text"
                       name="nidn"
                       value="{{ old('nidn') }}"
                       placeholder="Masukkan NIDN"
                       class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
            </div>

            <div>
                <label for="bidang_keahlian" class="block text-sm font-semibold text-gray-700 mb-1">
                    Bidang Keahlian
                </label>

                <input id="bidang_keahlian"
                       type="text"
                       name="bidang_keahlian"
                       value="{{ old('bidang_keahlian') }}"
                       placeholder="Contoh: Rekayasa Perangkat Lunak"
                       class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

                <x-input-error :messages="$errors->get('bidang_keahlian')" class="mt-2" />
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   placeholder="Masukkan password"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">
                Konfirmasi Password
            </label>

            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   placeholder="Ulangi password"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
                class="w-full py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold shadow-lg shadow-blue-500/30 transition">
            Daftar Sekarang
        </button>

        <div class="text-center">
            <a href="{{ route('login') }}"
               class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                Sudah punya akun? Login
            </a>
        </div>
    </form>

    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            const mahasiswaFields = document.getElementById('mahasiswa-fields');
            const dosenFields = document.getElementById('dosen-fields');

            mahasiswaFields.classList.add('hidden');
            dosenFields.classList.add('hidden');

            if (role === 'mahasiswa') {
                mahasiswaFields.classList.remove('hidden');
            }

            if (role === 'dosen') {
                dosenFields.classList.remove('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleRoleFields();
        });
    </script>
</x-guest-layout>