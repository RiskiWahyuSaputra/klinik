@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-2">Rekam Medis</h1>
    <p class="text-gray-500 mb-8">Riwayat rekam medis Anda</p>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Dokter</th>
                        <th class="px-6 py-4 font-medium">Diagnosis</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $record->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">dr. {{ $record->appointment->doctor->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($record->diagnosis, 50) }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('medical-records.show', $record) }}" class="text-sm font-medium hover:underline" style="color: #D4AF37;">Lihat</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">📋</p>
                            <p>Belum ada rekam medis.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $records->links() }}
    </div>
</div>
@endsection