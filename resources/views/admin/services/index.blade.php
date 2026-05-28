@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800">Kelola Layanan</h1>
        <a href="{{ route('admin.services.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Tambah Layanan
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Nama Layanan</th>
                        <th class="px-6 py-4 font-medium">Deskripsi</th>
                        <th class="px-6 py-4 font-medium">Harga</th>
                        <th class="px-6 py-4 font-medium">Durasi</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $service->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $service->description ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium" style="color: #D4AF37;">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $service->duration }} menit</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-sm font-medium hover:underline text-blue-500">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Hapus layanan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-sm text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">🩺</p>
                            <p>Belum ada layanan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $services->links() }}
    </div>
</div>
@endsection