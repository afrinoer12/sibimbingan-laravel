<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">
            Masuk ke Sistem
        </h2>
        <p class="text-gray-500 text-sm mt-1">
            Gunakan akun admin, mahasiswa, atau dosen.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                Email
            </label>

            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username"
                   placeholder="Masukkan email"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="Masukkan password"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">
                    Ingat saya
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                   href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit"
                class="w-full py-3 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold shadow-lg shadow-blue-500/30 transition">
            Login Sekarang
        </button>
        <div class="text-center mt-5">
            <p class="text-sm text-gray-500">
                Belum punya akun?
                <a href="{{ route('register') }}"
                class="font-bold text-blue-600 hover:text-blue-800">
                    Daftar di sini
                </a>
            </p>
        </div>
    </form>

    
</x-guest-layout>