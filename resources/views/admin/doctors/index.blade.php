@extends('layouts.app')

@section('title', 'Kelola Dokter')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800">Kelola Dokter</h1>
        <a href="{{ route('admin.doctors.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Tambah Dokter
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Nama</th>
                        <th class="px-6 py-4 font-medium">Spesialisasi</th>
                        <th class="px-6 py-4 font-medium">Telepon</th>
                        <th class="px-6 py-4 font-medium">Pengalaman</th>
                        <th class="px-6 py-4 font-medium">Layanan</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">dr. {{ $doctor->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->specialization ?? 'Dokter Umum' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->user->phone ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->experience_years ?? 0 }} tahun</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->services->pluck('name')->implode(', ') ?: '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="text-sm font-medium text-blue-500 hover:underline">Edit</a>
                                <a href="{{ route('admin.schedules', $doctor) }}" class="text-sm font-medium hover:underline" style="color: #D4AF37;">Jadwal</a>
                                <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" onsubmit="return confirm('Hapus dokter ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">👨‍⚕️</p>
                            <p>Belum ada dokter.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $doctors->links() }}
    </div>
</div>
@endsection