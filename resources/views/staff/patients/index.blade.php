@extends('layouts.staff')

@section('title', 'Pasien')
@section('breadcrumb', 'Pasien')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="page-title">Daftar Pasien</h1>
        <a href="{{ route('staff.patients.create') }}" class="text-white px-5 py-3 rounded-xl font-medium transition shadow-md hover:shadow-lg" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
            + Pasien Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl p-4 mb-6 shadow-sm">
        <form method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/email/telepon..." class="px-4 py-2 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition flex-1 min-w-[200px]">
            <button type="submit" class="px-5 py-2 rounded-xl text-white font-medium transition shadow" style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">Cari</button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">No. Pasien</th>
                        <th class="px-6 py-4 font-medium">Nama</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Telepon</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $patient->patient_number ?? 'P-'.str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $patient->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $patient->user->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $patient->phone ?? $patient->user->phone ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <span class="text-sm text-gray-400">-</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">👤</p>
                            <p>Tidak ada pasien.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $patients->links() }}
    </div>
</div>
@endsection