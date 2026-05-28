@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('content')
<div class="bg-white rounded-2xl shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Rekam Medis Pasien</h2>
    </div>

    @if($records->isEmpty())
        <div class="text-center py-12 text-gray-400">
            <div class="text-4xl mb-3">📋</div>
            <p>Belum ada rekam medis</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b">
                        <th class="pb-3 font-medium">Tanggal</th>
                        <th class="pb-3 font-medium">Pasien</th>
                        <th class="pb-3 font-medium">Diagnosis</th>
                        <th class="pb-3 font-medium">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50">
                        <td class="py-3 text-sm text-gray-600">{{ $record->created_at->format('d/m/Y') }}</td>
                        <td class="py-3">
                            <span class="font-medium text-gray-800">{{ $record->patient->user->name ?? '-' }}</span>
                        </td>
                        <td class="py-3 text-sm text-gray-600 max-w-xs truncate">{{ $record->diagnosis ?? '-' }}</td>
                        <td class="py-3">
                            <a href="{{ route('medical-records.show', $record) }}" class="text-pink-500 hover:text-pink-600 text-sm font-medium">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $records->links() }}
        </div>
    @endif
</div>
@endsection
