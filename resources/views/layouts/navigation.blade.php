<nav x-data="{ open: false }" class="bg-white/90 backdrop-blur-xl border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-20">

            {{-- LEFT --}}
            <div class="flex items-center gap-8">

                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-gray-200 flex items-center justify-center shadow-lg overflow-hidden">
                        <img src="{{ asset('images/logo_kampus.png') }}"
                            alt="Logo Kampus"
                            class="w-11 h-10 object-contain">
                    </div>

                    <div>
                        <h1 class="font-black text-gray-900 leading-none">
                            SIBIMBINGAN
                        </h1>
                        <p class="text-xs text-gray-500 mt-1">
                            Skripsi Online
                        </p>
                    </div>
                </a>

                {{-- MENU DESKTOP --}}
                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('admin.pengajuan-judul.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.pengajuan-judul.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Pengajuan Judul
                        </a>

                        @if (Route::has('admin.laporan-bimbingan.index'))
                            <a href="{{ route('admin.laporan-bimbingan.index') }}"
                               class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.laporan-bimbingan.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                                Laporan
                            </a>
                        @endif
                    @endif

                    @if (Auth::user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.dashboard') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('mahasiswa.pengajuan-judul.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('mahasiswa.pengajuan-judul.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Judul Skripsi
                        </a>

                        <a href="{{ route('mahasiswa.bimbingan.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('mahasiswa.bimbingan.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Bimbingan
                        </a>
                    @endif

                    @if (Auth::user()->role === 'dosen')
                        <a href="{{ route('dosen.dashboard') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('dosen.dashboard') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('dosen.pengajuan-judul.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('dosen.pengajuan-judul.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Pengajuan Judul
                        </a>

                        <a href="{{ route('dosen.bimbingan.index') }}"
                           class="px-4 py-2 rounded-xl text-sm font-semibold {{ request()->routeIs('dosen.bimbingan.*') ? 'bg-blue-600 text-white shadow' : 'text-gray-600 hover:bg-gray-100' }}">
                            Data Bimbingan
                        </a>
                    @endif
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="hidden sm:flex sm:items-center sm:gap-4">
                <div class="text-right">
                </div>

                <div class="relative" x-data="{ dropdown: false }">
                    <button @click="dropdown = ! dropdown"
                            class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white font-bold shadow">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </button>

                    <div x-show="dropdown"
                         @click.outside="dropdown = false"
                         x-transition
                         class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">

                        @if (Route::has('profile.edit'))
                            <a href="{{ route('profile.edit') }}"
                               class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                Profil Saya
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="w-full text-left px-5 py-3 text-sm text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- MOBILE BUTTON --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-xl text-gray-600 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200 bg-white">
        <div class="px-4 py-4 space-y-2">

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Dashboard
                </a>

                <a href="{{ route('admin.pengajuan-judul.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Pengajuan Judul
                </a>

                @if (Route::has('admin.laporan-bimbingan.index'))
                    <a href="{{ route('admin.laporan-bimbingan.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                        Laporan
                    </a>
                @endif
            @endif

            @if (Auth::user()->role === 'mahasiswa')
                <a href="{{ route('mahasiswa.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Dashboard
                </a>

                <a href="{{ route('mahasiswa.pengajuan-judul.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Judul Skripsi
                </a>

                <a href="{{ route('mahasiswa.bimbingan.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Bimbingan
                </a>
            @endif

            @if (Auth::user()->role === 'dosen')
                <a href="{{ route('dosen.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Dashboard
                </a>

                <a href="{{ route('dosen.pengajuan-judul.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Pengajuan Judul
                </a>

                <a href="{{ route('dosen.bimbingan.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    Data Bimbingan
                </a>
            @endif

            <div class="border-t pt-3 mt-3">
                <p class="px-4 text-sm font-bold text-gray-800">
                    {{ Auth::user()->name }}
                </p>
                <p class="px-4 text-xs text-gray-500 capitalize">
                    {{ Auth::user()->role }}
                </p>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>