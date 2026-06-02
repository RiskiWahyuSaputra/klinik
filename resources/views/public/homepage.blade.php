<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Utama Mon Cheri — Layanan Kesehatan Profesional & Terpercaya</title>
    <meta name="description" content="Klinik Utama Mon Cheri menyediakan layanan kesehatan profesional dengan sentuhan kasih sayang. Booking appointment online dengan mudah.">
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        rose: {
                            50: '#FFF1F2', 100: '#FFE4E6', 200: '#FECDD3',
                            300: '#FDA4AF', 400: '#FB7185', 500: '#F43F5E',
                            600: '#E11D48', 700: '#BE123C', 800: '#9F1239',
                            900: '#881337', 950: '#4C0519', 1000: '#000000',
                        },
                        gold: {
                            50: '#FFFBEB', 100: '#FEF3C7', 200: '#FDE68A',
                            300: '#FCD34D', 400: '#FBBF24', 500: '#D4AF37',
                            600: '#B8860B', 700: '#8B6914', 800: '#6E520F',
                            900: '#553E0C', 950: '#3A2908',
                        },
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #FFF1F2; }
        ::-webkit-scrollbar-thumb { background: #FDA4AF; border-radius: 10px; }

        /* ── Hero background image ── */
        .hero-screen {
            min-height: 100vh;
            min-height: 100dvh;
            background: url('/images/bg-hero.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* ── Floating particles ── */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
        }

        /* ── Glass card ── */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
        }

        /* ── Card lift ── */
        .card-lift {
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px -15px rgba(244, 63, 94, 0.2);
        }

        /* ── Gold shimmer CTA ── */
        .btn-gold {
            background: linear-gradient(135deg, #D4AF37 0%, #F5D060 50%, #D4AF37 100%);
            background-size: 200% 200%;
            animation: shimmer 3s ease infinite;
            color: #4A3705; /* Darker text for better contrast */
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.4);
            transform: translateY(-2px);
            color: #2D2203;
        }
        @keyframes shimmer {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .btn-rose {
            background: linear-gradient(135deg, #F43F5E 0%, #FB7185 100%);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-rose:hover {
            box-shadow: 0 8px 30px rgba(244, 63, 94, 0.3);
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid white;
            color: white; /* Darker rose for better contrast */
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            background: #FFF1F2;
            border-color: #F43F5E;
            transform: translateY(-2px);
            color: #881337;
        }

        /* ── Section title ── */
        .section-title {
            font-family: 'Poppins', sans-serif;
            color: #1A1A1A; /* High contrast heading */
        }

        /* ── Nav transition ── */
        #navbar {
            transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            left: 50% !important;
            transform: translateX(-50%);
            will-change: transform, top, width, background, padding;
        }
        .nav-default { 
            background: transparent; 
            padding-top: 10px;
            top: 0;
            width: 100%;
        }
        .nav-scrolled {
            top: 24px !important;
            transform: translateX(-50%) scale(0.98);
            width: 92%;
            max-width: 1200px;
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 999px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            padding: 0 24px;
        }
        .nav-scrolled .h-16, .nav-scrolled .lg:h-20 {
            height: 64px;
            transition: height 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* ── Reveal animations ── */
        .reveal {
            opacity: 0;
            will-change: transform, opacity, filter;
        }

        /* ── Decorative ring ── */
        .deco-ring {
            border-radius: 50%;
            border: 3px solid rgba(212, 175, 55, 0.2);
        }

        /* ── Stat counter ── */
        .stat-number {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #D4AF37, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Scroll indicator ── */
        @keyframes scrollBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(8px); }
        }
        .scroll-indicator { animation: scrollBounce 2s ease-in-out infinite; }

        /* ── Underline decoration ── */
        .title-underline {
            position: relative;
            display: inline-block;
        }
        .title-underline::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #D4AF37, #FDA4AF);
            border-radius: 10px;
        }

        /* ── Icon container ── */
        .icon-box {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ── Decorative shapes ── */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.3;
            pointer-events: none;
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="bg-white text-gray-800 antialiased">

<!-- ════════════════════ NAVIGATION ════════════════════ -->
<nav id="navbar" class="nav-default fixed z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 lg:h-20">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-400 to-rose-500 flex items-center justify-center shadow-lg shadow-rose-200 group-hover:shadow-rose-300 transition-shadow">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <span class="text-xl font-poppins font-bold text-gray-800 group-hover:text-rose-500 transition-colors">Mon Cheri</span>
            </a>

            <!-- Desktop nav -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="/" class="nav-link text-sm font-medium text-gray-700 hover:text-rose-500 transition-colors">Beranda</a>
                <a href="{{ route('public.services') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors">Layanan</a>
                <a href="{{ route('public.doctors') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors">Dokter</a>
                <a href="{{ route('public.articles') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors">Artikel</a>
                <a href="{{ route('public.contact') }}" class="nav-link text-sm font-medium text-gray-600 hover:text-rose-500 transition-colors">Kontak</a>
                <div class="flex items-center gap-3 ml-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-rose px-5 py-2.5 rounded-xl text-sm font-semibold text-white shadow-md shadow-rose-100">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-rose-1000 hover:text-rose-900 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-gold px-5 py-2.5 rounded-xl text-sm font-bold shadow-md">Daftar</a>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->
            <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center text-gray-600 hover:bg-rose-50 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white/97 backdrop-blur-xl border-t border-rose-100 shadow-xl">
        <div class="px-6 py-6 space-y-3">
            <a href="/" class="block text-gray-700 font-medium py-2.5 px-4 rounded-xl hover:bg-rose-50 transition-colors">Beranda</a>
            <a href="{{ route('public.services') }}" class="block text-gray-600 font-medium py-2.5 px-4 rounded-xl hover:bg-rose-50 transition-colors">Layanan</a>
            <a href="{{ route('public.doctors') }}" class="block text-gray-600 font-medium py-2.5 px-4 rounded-xl hover:bg-rose-50 transition-colors">Dokter</a>
            <a href="{{ route('public.articles') }}" class="block text-gray-600 font-medium py-2.5 px-4 rounded-xl hover:bg-rose-50 transition-colors">Artikel</a>
            <a href="{{ route('public.contact') }}" class="block text-gray-600 font-medium py-2.5 px-4 rounded-xl hover:bg-rose-50 transition-colors">Kontak</a>
            <div class="pt-4 border-t border-rose-100 flex flex-col gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-rose text-center px-5 py-3 rounded-xl font-semibold text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-center font-semibold text-rose-500 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-gold text-center px-5 py-3 rounded-xl font-bold">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<main>
<!-- ════════════════════ HERO — FULL SCREEN ════════════════════ -->
<section class="hero-screen relative flex items-center overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 pt-20 lg:pt-0">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
            <!-- Left: Text -->
            <div class="flex-1 text-center lg:text-left">
                <!-- Badge -->
                <div class="reveal inline-flex items-center gap-2 px-4 py-2 bg-white/80 backdrop-blur rounded-full text-xs font-bold text-rose-600 border border-rose-200/60 shadow-sm mb-6">
                   
                    LAYANAN KESEHATAN MON CHERI
                </div>

                <h1 class="reveal text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-6xl font-poppins font-extrabold leading-[1.1] text-gray-950 mb-6">
                    Kesehatan Anda,<br>
                    <span class="bg-gradient-to-r from-gold-600 to-gold-700 bg-clip-text" style="color:#B8860B">Prioritas Kami</span>
                </h1>

                <p class="reveal text-lg text-gray-800 max-w-xl mx-auto lg:mx-0 leading-relaxed mb-8">
                    <strong class="text-gray-900 font-bold">Klinik Utama Mon Cheri</strong> menyediakan layanan kesehatan profesional dengan sentuhan kasih sayang. Booking appointment secara online dengan mudah dan cepat.
                </p>

                <div class="reveal flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="btn-gold px-8 py-4 rounded-2xl font-bold text-base shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Buat Appointment
                    </a>
                    <a href="{{ route('public.services') }}" class="btn-outline px-8 py-4 rounded-2xl font-bold text-base flex items-center justify-center gap-2 cursor-pointer">
                        Lihat Layanan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

                <!-- Trust stats -->
                <div class="reveal flex flex-wrap gap-8 mt-10 justify-center lg:justify-start">
                    <div class="text-center lg:text-left">
                        <p class="stat-number text-3xl font-poppins font-extrabold">15+</p>
                        <p class="text-xs text-gray-500 mt-1">Tahun Pengalaman</p>
                    </div>
                    <div class="text-center lg:text-left">
                        <p class="stat-number text-3xl font-poppins font-extrabold">50K+</p>
                        <p class="text-xs text-gray-500 mt-1">Pasien Dilayani</p>
                    </div>
                    <div class="text-center lg:text-left">
                        <p class="stat-number text-3xl font-poppins font-extrabold">4.9</p>
                        <p class="text-xs text-gray-500 mt-1">Rating Pasien</p>
                    </div>
                </div>
            </div>

            <!-- Right: Visual -->
            
        </div>
    </div>

    <!-- Scroll indicator -->
    
</section>

<!-- ════════════════════ TRUST STRIP ════════════════════ -->
<section class="py-6 bg-white border-y border-rose-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center items-center gap-x-10 gap-y-4 text-sm text-gray-400">
            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-gold-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>Terakreditasi</span>
            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>Privasi Terjamin</span>
            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>Tanpa Waktu Tunggu</span>
            <span class="flex items-center gap-2"><svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>Pembayaran Mudah</span>
        </div>
    </div>
</section>

<!-- ════════════════════ SERVICES ════════════════════ -->
<section id="services" class="py-20 lg:py-28 relative overflow-hidden">
    <div class="blob w-[600px] h-[600px] bg-rose-100 top-[-200px] right-[-200px]"></div>
    <div class="blob w-[500px] h-[500px] bg-gold-100 bottom-[-150px] left-[-150px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="reveal inline-flex items-center gap-2 px-4 py-2 bg-rose-50 rounded-full text-xs font-bold text-rose-500 mb-4">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                LAYANAN KAMI
            </div>
            <h2 class="reveal section-title text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                Layanan Kesehatan <span class="title-underline">Berkualitas</span>
            </h2>
            <p class="reveal text-gray-500 leading-relaxed">Berbagai layanan kesehatan profesional untuk memenuhi kebutuhan Anda dan keluarga.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($services as $service)
            <div class="reveal card-lift bg-white rounded-2xl p-6 lg:p-8 border border-rose-100/80 shadow-sm hover:border-rose-200">
                <div class="icon-box bg-gradient-to-br from-rose-50 to-rose-100 mb-5">
                    <svg class="w-7 h-7 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-poppins font-bold text-gray-900 mb-2">{{ $service->name }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ Str::limit($service->description, 120) }}</p>
                <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                    <span class="text-lg font-bold text-gold-500 font-poppins">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                    <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">{{ $service->duration }} menit</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="reveal text-center mt-12">
            <a href="{{ route('public.services') }}" class="btn-rose inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold text-white shadow-lg shadow-rose-200 cursor-pointer">
                Lihat Semua Layanan
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ════════════════════ WHY CHOOSE US ════════════════════ -->
<section class="py-20 lg:py-28 bg-gradient-to-b from-white via-rose-50/30 to-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="reveal inline-flex items-center gap-2 px-4 py-2 bg-gold-50 rounded-full text-xs font-bold text-gold-600 mb-4">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                KENAPA MON CHERI
            </div>
            <h2 class="reveal section-title text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                Keunggulan <span class="title-underline">Kami</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="reveal text-center p-8 rounded-3xl bg-white border border-rose-100/60 shadow-sm">
                <div class="icon-box bg-gradient-to-br from-rose-100 to-rose-50 mx-auto mb-5">
                    <svg class="w-7 h-7 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h3 class="text-lg font-poppins font-bold text-gray-900 mb-3">Dokter Profesional</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Tim dokter berpengalaman dan tersertifikasi yang siap memberikan perawatan terbaik.</p>
            </div>
            <div class="reveal text-center p-8 rounded-3xl bg-white border border-gold-100/60 shadow-sm">
                <div class="icon-box bg-gradient-to-br from-gold-100 to-gold-50 mx-auto mb-5">
                    <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <h3 class="text-lg font-poppins font-bold text-gray-900 mb-3">Privasi Terjamin</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Data kesehatan Anda aman dan terlindungi sesuai standar privasi medis terbaik.</p>
            </div>
            <div class="reveal text-center p-8 rounded-3xl bg-white border border-rose-100/60 shadow-sm">
                <div class="icon-box bg-gradient-to-br from-rose-100 to-rose-50 mx-auto mb-5">
                    <svg class="w-7 h-7 text-rose-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-poppins font-bold text-gray-900 mb-3">Booking Online 24/7</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Jadwalkan appointment kapan saja secara online tanpa perlu menelepon atau datang langsung.</p>
            </div>
        </div>
    </div>
</section>

<!-- ════════════════════ DOCTORS ════════════════════ -->
<section class="py-20 lg:py-28 relative overflow-hidden bg-cover bg-center bg-no-bound" style="background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('/images/bg.jpg'); background-attachment: fixed;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="reveal inline-flex items-center gap-2 px-4 py-2 bg-rose-50 rounded-full text-xs font-bold text-rose-500 mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                TIM DOKTER
            </div>
            <h2 class="reveal section-title text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                Dokter <span class="title-underline">Profesional</span> Kami
            </h2>
            <p class="reveal text-gray-500 leading-relaxed">Dokter berpengalaman dan berdedikasi siap membantu perjalanan kesehatan Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($doctors as $doctor)
            <div class="reveal card-lift bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden">
                <div class="h-48 bg-gradient-to-br from-rose-100 via-rose-50 to-gold-50 flex items-center justify-center relative">
                    <div class="w-24 h-24 rounded-full bg-white/80 backdrop-blur shadow-md flex items-center justify-center overflow-hidden">
                        @if($doctor->photo)
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="dr. {{ $doctor->user->name }}"
                            class="w-full h-full object-cover">
                        @elseif($doctor->user->photo)
                        <img src="{{ asset('storage/' . $doctor->user->photo) }}" alt="dr. {{ $doctor->user->name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-rose-300 to-rose-400 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold font-[Poppins]">{{ substr($doctor->user->name, 0, 1) }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="absolute top-3 right-3 w-8 h-8 bg-white/80 backdrop-blur rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-gold-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>
                <div class="p-5 text-center">
                    <h3 class="font-poppins font-bold text-gray-900">dr. {{ $doctor->user->name }}</h3>
                    <p class="text-sm text-rose-400 font-medium mt-1">{{ $doctor->specialization ?? 'Dokter Umum' }}</p>
                    <div class="flex items-center justify-center gap-1 mt-3">
                        <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">{{ $doctor->experience_years ?? 0 }} tahun pengalaman</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="reveal text-center mt-12">
            <a href="{{ route('public.doctors') }}" class="btn-outline inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold cursor-pointer">
                Lihat Semua Dokter
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ════════════════════ ARTICLES ════════════════════ -->
@if($articles->count() > 0)
<section class="py-20 lg:py-28 bg-gradient-to-b from-rose-50/40 to-white relative overflow-hidden">
    <div class="blob w-[400px] h-[400px] bg-rose-100 bottom-[-100px] right-[-100px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="reveal inline-flex items-center gap-2 px-4 py-2 bg-rose-50 rounded-full text-xs font-bold text-rose-500 mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                ARTIKEl KESEHATAN
            </div>
            <h2 class="reveal section-title text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                Tips & Info <span class="title-underline">Kesehatan</span>
            </h2>
            <p class="reveal text-gray-500 leading-relaxed">Artikel kesehatan terbaru dari tim medis kami untuk menjaga kesehatan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <div class="reveal card-lift bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group cursor-pointer">
                <div class="h-44 bg-gradient-to-br from-rose-100 via-rose-50 to-gold-50 flex items-center justify-center relative overflow-hidden">
                    @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-white/60 to-transparent"></div>
                    @else
                    <svg class="w-16 h-16 text-rose-200 group-hover:text-rose-300 transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/></svg>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="font-poppins font-bold text-gray-900 mb-2 group-hover:text-rose-500 transition-colors">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ Str::limit($article->excerpt, 100) }}</p>
                    <a href="{{ route('public.article', $article->slug) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-gold-500 hover:text-gold-600 transition-colors">
                        Baca Selengkapnya
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="reveal text-center mt-12">
            <a href="{{ route('public.articles') }}" class="btn-outline inline-flex items-center gap-2 px-8 py-3.5 rounded-2xl font-bold cursor-pointer">
                Lihat Semua Artikel
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- ════════════════════ CONTACT / CTA ════════════════════ -->
<section class="py-20 lg:py-28 relative overflow-hidden" style="background: linear-gradient(135deg, #FFF8FA 0%, #FFE4EC 50%, #FFF8DC 100%);">
    <div class="blob w-[400px] h-[400px] bg-rose-200 top-[-100px] left-[-100px]"></div>
    <div class="blob w-[300px] h-[300px] bg-gold-200 bottom-[-50px] right-[-50px]"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="reveal">
            <h2 class="section-title text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-950 mb-4">
                Siap Memulai <span class="bg-gradient-to-r from-gold-700 to-gold-800 bg-clip-text" style="color:#B8860B">Perawatan Kesehatan</span> Anda?
            </h2>
            <p class="text-gray-800 text-lg mb-10 max-w-2xl mx-auto leading-relaxed font-medium">Hubungi kami atau buat appointment secara online. Kami siap melayani Anda dengan sepenuh hati.</p>
        </div>

        <div class="reveal flex flex-col sm:flex-row justify-center gap-4 mb-12">
            <a href="{{ route('register') }}" class="btn-gold px-10 py-4 rounded-2xl font-bold text-base shadow-lg flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Buat Appointment
            </a>
            <a href="{{ route('public.contact') }}" class="btn-outline px-10 py-4 rounded-2xl font-bold text-base flex items-center justify-center gap-2 cursor-pointer">
                Hubungi Kami
            </a>
        </div>

        <div class="reveal grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <svg class="w-8 h-8 text-rose-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                <p class="font-bold text-gray-800 text-sm">Telepon</p>
                <p class="text-gray-500 text-sm mt-1">(022) 1234-5678</p>
            </div>
            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <svg class="w-8 h-8 text-rose-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                <p class="font-bold text-gray-800 text-sm">Email</p>
                <p class="text-gray-500 text-sm mt-1">info@moncheri-klinik.id</p>
            </div>
            <div class="glass-card rounded-2xl p-6 shadow-sm">
                <svg class="w-8 h-8 text-rose-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                <p class="font-bold text-gray-800 text-sm">Lokasi</p>
                <p class="text-gray-500 text-sm mt-1">Jl. Contoh No. 123, Bandung</p>
            </div>
        </div>

        <div class="reveal mt-8">
            <div class="inline-flex items-center gap-4 glass-card rounded-2xl px-6 py-3 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-400"></div>
                    <span class="text-sm text-gray-600">Senin - Sabtu: 08:00 - 20:00</span>
                </div>
                <div class="w-px h-4 bg-gray-300"></div>
                <span class="text-sm text-gray-600">Minggu: 09:00 - 15:00</span>
            </div>
        </div>
    </div>
</section>
</main>

<!-- ════════════════════ FOOTER ════════════════════ -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- Brand -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-400 to-rose-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                    </div>
                    <span class="text-xl font-poppins font-bold">Mon Cheri</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">Klinik Utama Mon Cheri — layanan kesehatan profesional dengan sentuhan kasih sayang untuk Anda dan keluarga.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-poppins font-bold text-sm uppercase tracking-wider text-gold-400 mb-4">Navigasi</h4>
                <ul class="space-y-3">
                    <li><a href="/" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Beranda</a></li>
                    <li><a href="{{ route('public.services') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Layanan</a></li>
                    <li><a href="{{ route('public.doctors') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Dokter</a></li>
                    <li><a href="{{ route('public.articles') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Artikel</a></li>
                </ul>
            </div>

            <!-- Account -->
            <div>
                <h4 class="font-poppins font-bold text-sm uppercase tracking-wider text-gold-400 mb-4">Akun</h4>
                <ul class="space-y-3">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Dashboard</a></li>
                        <li><a href="{{ route('appointments.index') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Appointment Saya</a></li>
                    @else
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Daftar</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-rose-400 text-sm transition-colors">Masuk</a></li>
                    @endif
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-poppins font-bold text-sm uppercase tracking-wider text-gold-400 mb-4">Kontak</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        (022) 1234-5678
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        info@moncheri-klinik.id
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        Jl. Contoh No. 123, Bandung
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Klinik Utama Mon Cheri. All rights reserved.</p>
            <p class="text-gray-600 text-xs">Dibuin dengan <span class="text-rose-400">&#9829;</span> untuk kesehatan Indonesia</p>
        </div>
    </div>
</footer>

<!-- ════════════════════ JAVASCRIPT ════════════════════ -->
<script>
    // ── Navbar scroll behavior ──
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.remove('nav-default');
            navbar.classList.add('nav-scrolled');
        } else {
            navbar.classList.add('nav-default');
            navbar.classList.remove('nav-scrolled');
        }
    });

    // ── Mobile menu toggle ──
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });
    }

    // ── GSAP ScrollTrigger ──
    gsap.registerPlugin(ScrollTrigger);

    // Hero animations with re-trigger on scroll to top
    gsap.fromTo('.hero-screen .reveal', 
        { 
            opacity: 0, 
            y: 20
        },
        { 
            scrollTrigger: {
                trigger: '.hero-screen',
                start: 'top 50%',
                toggleActions: 'play none none reverse'
            },
            opacity: 1, 
            y: 0, 
            duration: 0.8, 
            stagger: 0.1, 
            ease: 'expo.out'
        }
    );

    // Enhanced Section reveals with repeatable animation
    document.querySelectorAll('.reveal').forEach((el, index) => {
        // Skip hero reveals as they are handled above
        if (el.closest('.hero-screen')) return;

        gsap.fromTo(el, 
            { 
                opacity: 0, 
                y: 30,
                scale: 0.96,
                filter: 'blur(8px)',
                rotateX: -5
            },
            {
                scrollTrigger: {
                    trigger: el,
                    start: 'top 92%',
                    toggleActions: 'play reverse play reverse'
                },
                opacity: 1,
                y: 0,
                scale: 1,
                filter: 'blur(0px)',
                rotateX: 0,
                duration: 1.2,
                ease: 'expo.out',
                delay: el.classList.contains('card-lift') ? (index % 3) * 0.08 : 0
            }
        );
    });

    // ── Floating particles in hero ──
    const particleContainer = document.getElementById('hero-particles');
    if (particleContainer) {
        const colors = ['#FECDD3', '#FCD34D', '#FDA4AF', '#FBBF24'];
        for (let i = 0; i < 12; i++) {
            const p = document.createElement('div');
            p.classList.add('particle');
            const size = Math.random() * 12 + 4;
            p.style.cssText = `
                width: ${size}px; height: ${size}px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
                opacity: ${Math.random() * 0.25 + 0.05};
                animation: floatParticle ${Math.random() * 6 + 4}s ease-in-out infinite;
                animation-delay: ${Math.random() * 3}s;
            `;
            particleContainer.appendChild(p);
        }

        const style = document.createElement('style');
        style.textContent = `
            @keyframes floatParticle {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                33% { transform: translateY(-30px) rotate(120deg); }
                66% { transform: translateY(15px) rotate(240deg); }
            }
        `;
        document.head.appendChild(style);
    }
</script>

</body>
</html>