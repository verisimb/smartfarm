<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartFarm') }} - Management</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('LogoOnly.svg') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

        <!-- Hugeicons Free Icon Font CDN -->
        <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900 selection:bg-emerald-500 selection:text-white">
        
        <div class="flex min-h-screen">
            <!-- Desktop Sidebar -->
            <aside class="hidden md:flex w-64 shrink-0 flex-col border-r border-slate-200 bg-white/80 backdrop-blur-md sticky top-0 h-screen">
                <div class="flex h-16 items-center px-6 border-b border-slate-100">
                    <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                        <img src="{{ asset('Logo-text.svg') }}" alt="SmartFarm Logo" class="h-7 w-auto" />
                    </a>
                </div>
                
                <div class="flex-1 overflow-y-auto px-4 py-6">
                    <div class="mb-4">
                        <span class="px-3 text-[10px] font-semibold uppercase tracking-wider text-slate-400">Utama</span>
                        <nav class="mt-2 space-y-1">
                            <x-nav-link-custom :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="hgi-analytics-01">
                                Dashboard
                            </x-nav-link-custom>
                        </nav>
                    </div>

                    <div class="mb-4">
                        <span class="px-3 text-[10px] font-semibold uppercase tracking-wider text-slate-400">Prediksi Lahan</span>
                        <nav class="mt-2 space-y-1">
                            <x-nav-link-custom :href="route('predictions.create')" :active="request()->routeIs('predictions.create')" icon="hgi-test-tube">
                                Prediksi Baru
                            </x-nav-link-custom>
                            <x-nav-link-custom :href="route('predictions.index')" :active="request()->routeIs(['predictions.index', 'predictions.show', 'predictions.edit'])" icon="hgi-database-01">
                                Riwayat Lahan
                            </x-nav-link-custom>
                        </nav>
                    </div>

                    <div class="mt-auto pt-6 border-t border-slate-100">
                        <x-nav-link-custom :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="hgi-user">
                            Profil Saya
                        </x-nav-link-custom>
                    </div>
                </div>

                <div class="p-4 border-t border-slate-100">
                    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-logout')" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-slate-600 transition-all duration-300 hover:bg-red-50 hover:text-red-600 group">
                        <i class="hgi-stroke hgi-logout-03 text-lg transition-transform group-hover:-translate-x-1"></i>
                        Keluar Akun
                    </button>
                </div>
            </aside>

            <!-- Mobile Navbar Overlay & Sidebar (simplified for now or use Alpine.js) -->
            <!-- For brevity and consistency with Breeze, we can use a mobile top bar and a simple drawer -->

            <div class="flex-1 flex flex-col min-w-0">
                <!-- Top Header -->
                <header class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-slate-200/80 bg-white/80 px-4 backdrop-blur-md sm:gap-x-6 sm:px-6 lg:px-8">
                    <button type="button" class="-m-2.5 p-2.5 text-slate-700 md:hidden" id="open-sidebar">
                        <span class="sr-only">Open sidebar</span>
                        <i class="hgi-stroke hgi-menu-01 text-2xl"></i>
                    </button>

                    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                        <div class="flex flex-1 items-center">
                            @isset($header)
                                <h1 class="text-lg font-bold font-outfit text-slate-900 truncate">
                                    {{ $header }}
                                </h1>
                            @endisset
                        </div>
                        
                        <div class="flex items-center gap-x-4 lg:gap-x-6">
                            <!-- Notification or User Dropdown -->
                            <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-full bg-slate-50 border border-slate-100">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="hidden sm:block">
                                    <p class="text-xs font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] text-slate-500 leading-none mt-1">Petani Modern</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 py-8 px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Logout Confirmation Modal -->
        <x-modal name="confirm-logout" focusable>
            <div class="p-6">
                <h2 class="text-lg font-bold font-outfit text-slate-900">
                    Konfirmasi Keluar Akun
                </h2>
                <p class="mt-2 text-sm text-slate-500">
                    Apakah Anda yakin ingin keluar dari akun Anda? Sesi Anda akan berakhir dan Anda harus masuk kembali untuk mengelola data lahan Anda.
                </p>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close-modal', 'confirm-logout')" class="px-5 py-2.5 rounded-full border border-slate-200 hover:bg-slate-50 text-sm font-bold text-slate-500 transition-all">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-sm font-bold text-white transition-all">
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </x-modal>

        @stack('scripts')
    </body>
</html>
