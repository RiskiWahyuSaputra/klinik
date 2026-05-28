<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Utama Mon Cheri - Layanan Kesehatan Terbaik</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-[Inter]">
    <nav class="bg-white shadow-sm fixed w-full z-50" style="border-bottom: 3px solid #FFB6C1;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="text-2xl font-bold font-[Poppins]" style="color: #D4AF37;">Mon Cheri</a>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="text-gray-600 hover:text-pink-500 transition">Beranda</a>
                    <a href="{{ route('public.services') }}" class="text-gray-600 hover:text-pink-500 transition">Layanan</a>
                    <a href="{{ route('public.doctors') }}" class="text-gray-600 hover:text-pink-500 transition">Dokter</a>
                    <a href="{{ route('public.articles') }}" class="text-gray-600 hover:text-pink-500 transition">Artikel</a>
                    <a href="{{ route('public.contact') }}" class="text-gray-600 hover:text-pink-500 transition">Kontak</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-white px-5 py-2 rounded-lg font-medium transition" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white px-5 py-2 rounded-lg font-medium transition" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="pt-16" style="background: linear-gradient(135deg, #FFF8DC 0%, #FFB6C1 50%, #FFC0CB 100%);">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold font-[Poppins] text-gray-800 leading-tight">
                        Kesehatan Anda, <br>
                        <span style="color: #D4AF37;">Prioritas Kami</span>
                    </h1>
                    <p class="text-gray-600 text-lg mt-4 leading-relaxed">
                        Klinik Utama Mon Cheri menyediakan layanan kesehatan profesional dengan sentuhan kasih sayang.
                        Booking appointment dengan mudah secara online.
                    </p>
                    <div class="mt-8 flex space-x-4">
                        <a href="{{ route('register') }}" class="text-white px-8 py-3 rounded-xl font-semibold text-lg shadow-lg hover:shadow-xl transition" style="background: linear-gradient(135deg, #D4AF37, #B8860B);">
                            Buat Appointment
                        </a>
                        <a href="{{ route('public.services') }}" class="bg-white text-gray-700 px-8 py-3 rounded-xl font-semibold text-lg shadow hover:shadow-lg transition border border-gray-200">
                            Lihat Layanan
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="w-80 h-80 bg-white rounded-full shadow-2xl flex items-center justify-center" style="background: radial-gradient(circle, #FFF8DC, #FFB6C1);">
                        <span class="text-6xl">🏥</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold font-[Poppins] text-gray-800">Layanan Kami</h2>
                <p class="text-gray-500 mt-2">Berbagai layanan kesehatan berkualitas untuk Anda</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition border border-gray-100">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center text-2xl mb-4" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                        🩺
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $service->name }}</h3>
                    <p class="text-gray-500 mt-2 text-sm">{{ Str::limit($service->description, 100) }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold" style="color: #D4AF37;">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-400">{{ $service->duration }} menit</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('public.services') }}" class="inline-block text-white px-8 py-3 rounded-xl font-semibold shadow hover:shadow-lg transition" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>

    <section class="py-16" style="background: #FFF8DC;">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold font-[Poppins] text-gray-800">Tim Dokter Kami</h2>
                <p class="text-gray-500 mt-2">Dokter profesional dan berpengalaman</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($doctors as $doctor)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 text-center">
                    <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center text-3xl mb-4" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                        👨‍⚕️
                    </div>
                    <h3 class="font-semibold text-gray-800">dr. {{ $doctor->user->name }}</h3>
                    <p class="text-sm text-pink-400 mt-1">{{ $doctor->specialization ?? 'Dokter Umum' }}</p>
                    <p class="text-xs text-gray-400 mt-2">{{ $doctor->experience_years ?? 0 }} tahun pengalaman</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('public.doctors') }}" class="inline-block text-white px-8 py-3 rounded-xl font-semibold shadow hover:shadow-lg transition" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Lihat Semua Dokter
                </a>
            </div>
        </div>
    </section>

    @if($articles->count() > 0)
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold font-[Poppins] text-gray-800">Artikel Kesehatan</h2>
                <p class="text-gray-500 mt-2">Tips dan informasi kesehatan terbaru</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($articles as $article)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden border border-gray-100">
                    <div class="h-48 flex items-center justify-center text-4xl" style="background: linear-gradient(135deg, #FFF8DC, #FFB6C1);">
                        📝
                    </div>
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800">{{ $article->title }}</h3>
                        <p class="text-gray-500 text-sm mt-2">{{ Str::limit($article->excerpt, 100) }}</p>
                        <a href="{{ route('public.article', $article->slug) }}" class="inline-block mt-4 font-semibold hover:underline" style="color: #D4AF37;">Baca Selengkapnya →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="py-16" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold font-[Poppins] text-white mb-4">Hubungi Kami</h2>
            <p class="text-white/90 mb-8">Senin - Sabtu: 08:00 - 20:00 | Minggu: 09:00 - 15:00</p>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-8">
                <div class="bg-white/20 backdrop-blur rounded-xl px-6 py-4 text-white">
                    📞 (022) 1234-5678
                </div>
                <div class="bg-white/20 backdrop-blur rounded-xl px-6 py-4 text-white">
                    📧 info@moncheri-klinik.id
                </div>
                <div class="bg-white/20 backdrop-blur rounded-xl px-6 py-4 text-white">
                    📍 Jl. Contoh No. 123, Bandung
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-2xl font-bold font-[Poppins]" style="color: #D4AF37;">Mon Cheri</p>
            <p class="text-gray-400 mt-2">Klinik Utama</p>
            <p class="text-gray-500 text-sm mt-4">&copy; {{ date('Y') }} Klinik Utama Mon Cheri. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>