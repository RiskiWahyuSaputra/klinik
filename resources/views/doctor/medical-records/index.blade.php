@extends('layouts.doctor')

@section('title', 'Rekam Medis')
@section('breadcrumb', 'Rekam Medis')

@section('content')
<div class="admin-card p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Rekam Medis Pasien</h2>
    </div>

    @if($records->isEmpty())
        <div class="text-center py-12 text-gray-400">
            <div class="text-4xl mb-3">📋</div>
            <p>Belum ada rekam medis</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Diagnosis</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr>
                        <td data-label="Tanggal">{{ $record->created_at->format('d/m/Y') }}</td>
                        <td data-label="Pasien">{{ $record->patient->user->name ?? '-' }}</td>
                        <td data-label="Diagnosis" class="max-w-xs truncate">{{ $record->diagnosis ?? '-' }}</td>
                        <td data-label="Tindakan">
                            <a href="{{ route('medical-records.show', $record) }}" class="btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination-wrap">
            {{ $records->links() }}
        </div>
    @endif
</div>
@endsection
