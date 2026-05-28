<nav class="bg-white shadow-lg" style="border-bottom: 3px solid #FFB6C1;">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-2xl font-bold" style="color: #D4AF37; font-family: 'Poppins', sans-serif;">Mon Cheri</span>
                    <span class="text-sm ml-2 text-gray-600 hidden sm:inline">Klinik Utama</span>
                </a>
            </div>

            @auth
                <div class="flex items-center space-x-4">
                    @php $role = auth()->user()->role; @endphp

                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-pink-500 transition px-3 py-2 rounded-lg hover:bg-pink-50">
                        Dashboard
                    </a>

                    @if($role === 'patient')
                        <a href="{{ route('appointments.create') }}" class="text-white px-4 py-2 rounded-lg font-medium transition shadow-sm hover:shadow-md" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                            Buat Appointment
                        </a>
                    @endif

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-pink-500 transition">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-medium" style="background: linear-gradient(135deg, #FFB6C1, #D4AF37);">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="hidden md:inline">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50">
                            @if($role === 'patient')
                                <a href="{{ route('patient.profile') }}" class="block px-4 py-2 text-gray-600 hover:bg-pink-50 hover:text-pink-600">Profil Saya</a>
                                <a href="{{ route('appointments.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-pink-50 hover:text-pink-600">Riwayat Appointment</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-600 hover:bg-pink-50 hover:text-pink-600">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-pink-500 transition px-3 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-white px-5 py-2 rounded-lg font-medium transition shadow-sm hover:shadow-md" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>