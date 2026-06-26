<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartFarm') }} - Autentikasi</title>
        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('LogoOnly.svg') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

        <!-- Hugeicons CDN -->
        <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 selection:bg-emerald-500 selection:text-white">
        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Side: Visual/Branding Panel (Hidden on mobile) -->
            <div class="hidden md:flex md:w-1/2 bg-linear-to-br from-emerald-700 to-emerald-600 text-white p-12 flex-col justify-between relative overflow-hidden">
                <!-- Decorative background elements -->
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(186,210,132,0.15),transparent_45%)]"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl"></div>
                <div class="absolute top-1/2 right-0 w-80 h-80 rounded-full bg-emerald-400/5 blur-3xl"></div>
                
                <!-- Logo -->
                <div class="relative z-10">
                    <a href="/">
                        <img src="{{ asset('Logo-text.svg') }}" alt="SmartFarm Logo" class="h-8 w-auto brightness-0 invert" />
                    </a>
                </div>

                <!-- Highlight Text / Features -->
                <div class="relative z-10 my-auto max-w-lg space-y-6">
                    <span class="inline-flex items-center gap-1.5 bg-white/10 border border-white/15 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-emerald-50">
                        <i class="hgi-stroke hgi-sparkles text-emerald-100"></i> Smart Decision Support
                    </span>
                    <h2 class="text-4xl lg:text-5xl font-bold font-outfit leading-tight">
                        Optimalkan Lahan dengan <br>
                        <span class="font-serif font-normal italic text-emerald-100">Machine Learning</span>
                    </h2>
                    <p class="text-emerald-50/90 text-sm leading-relaxed">
                        Bergabunglah dengan ekosistem SmartFarm untuk memetakan jenis tanah secara otomatis menggunakan algoritma K-Means dan temukan jenis tanaman terbaik berdasarkan Random Forest Classifier.
                    </p>

                    <!-- Bullet features -->
                    <div class="grid grid-cols-2 gap-4 pt-4 text-xs font-semibold text-white">
                        <div class="flex items-center gap-2">
                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-emerald-100 border border-white/20">
                                <i class="hgi-stroke hgi-checkmark-circle-01 text-sm"></i>
                            </div>
                            Rekomendasi Jenis Tanaman
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-emerald-100 border border-white/20">
                                <i class="hgi-stroke hgi-checkmark-circle-01 text-sm"></i>
                            </div>
                            Segmentasi K-Means
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-emerald-100 border border-white/20">
                                <i class="hgi-stroke hgi-checkmark-circle-01 text-sm"></i>
                            </div>
                            Riwayat Lengkap
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex h-6 w-6 items-center justify-center rounded-full bg-white/10 text-emerald-100 border border-white/20">
                                <i class="hgi-stroke hgi-checkmark-circle-01 text-sm"></i>
                            </div>
                            Aman & Privat
                        </div>
                    </div>
                </div>

                <!-- Footer info -->
                <div class="relative z-10 text-xs text-emerald-100/60">
                    © 2026 SmartFarm. Hak Cipta Dilindungi.
                </div>
            </div>

            <!-- Right Side: Authentication Forms -->
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 md:px-12 lg:px-16 bg-white">
                <div class="w-full max-w-md space-y-8 animate-fade-in-up">
                    <!-- Mobile logo & title (Visible only on mobile) -->
                    <div class="md:hidden flex flex-col items-center text-center">
                        <a href="/">
                            <img src="{{ asset('Logo-text.svg') }}" alt="SmartFarm Logo" class="h-9 w-auto mb-6" />
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
