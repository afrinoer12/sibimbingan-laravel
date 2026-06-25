<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIBIMBINGAN</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-blue-950 to-indigo-950 flex items-center justify-center px-4 relative overflow-hidden">

        {{-- BACKGROUND GLOW --}}
        <div class="absolute top-[-120px] left-[-120px] w-96 h-96 bg-blue-500 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute bottom-[-120px] right-[-120px] w-96 h-96 bg-indigo-500 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-emerald-400 rounded-full blur-3xl opacity-10"></div>

        {{-- DECORATION GRID --}}
        <div class="absolute inset-0 opacity-[0.04]"
             style="background-image: linear-gradient(#ffffff 1px, transparent 1px), linear-gradient(90deg, #ffffff 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        {{-- CONTENT --}}
        <div class="relative z-10 w-full max-w-md">

            {{-- HEADER LOGIN --}}
            <div class="text-center mb-8">

                {{-- LOGO KAMPUS --}}
                <div class="relative mx-auto mb-5 w-28 h-28 group">
                    {{-- Efek glow belakang logo --}}
                    <div class="absolute -inset-2 bg-gradient-to-br from-blue-400 via-indigo-500 to-cyan-400 rounded-[2rem] blur-xl opacity-40 group-hover:opacity-70 transition duration-300"></div>

                    {{-- Frame logo --}}
                    <div class="relative w-28 h-28 rounded-[2rem] bg-white/95 border border-white/50 flex items-center justify-center shadow-2xl overflow-hidden p-4">
                        <div class="absolute inset-0 bg-gradient-to-br from-white via-blue-50 to-indigo-100"></div>

                        <img src="{{ asset('images/Logo_Adzkia.png') }}"
                             alt="Logo Kampus"
                             class="relative z-10 w-full h-full object-contain drop-shadow-md transition duration-300 group-hover:scale-110">
                    </div>
                </div>

                <h1 class="text-4xl font-black text-white tracking-tight drop-shadow-lg">
                    SIBIMBINGAN
                </h1>

                <p class="text-blue-100 mt-3 text-sm">
                    Sistem Bimbingan Skripsi Online Berbasis Laravel
                </p>
            </div>

            {{-- CARD FORM --}}
            <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8">
                {{ $slot }}
            </div>

            {{-- FOOTER --}}
            <p class="text-center text-blue-100 text-xs mt-6">
                © {{ date('Y') }} Sistem Bimbingan Skripsi Online
            </p>

        </div>
    </div>
</body>
</html>