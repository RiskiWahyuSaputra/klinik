<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klinik Mon Cheri</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-[Inter] bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold font-[Poppins]" style="color: #D4AF37;">Mon Cheri</h1>
            <p class="text-gray-600 mt-1">Klinik Utama</p>
        </div>

        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8" style="border-top: 4px solid #FFB6C1;">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
            <p class="text-gray-500 mb-6">Silakan login untuk melanjutkan</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('email') border-red-300 @enderror"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                        placeholder="Masukkan password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full text-white py-3 rounded-xl font-semibold text-lg transition shadow-md hover:shadow-lg"
                    style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Login
                </button>
            </form>

            <p class="text-center text-gray-500 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold hover:underline" style="color: #D4AF37;">Daftar</a>
            </p>
        </div>
    </div>
</body>
</html>