@extends('layouts.app')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto">
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-gray-500 hover:text-pink-500 transition mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-100" style="background: linear-gradient(135deg, #FFB6C1, #FFC0CB);">
                <h1 class="text-2xl font-bold font-[Poppins] text-gray-800">Rekam Medis</h1>
                <p class="text-gray-600 text-sm mt-1">{{ $record->created_at->format('d F Y H:i') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-400">Pasien</h3>
                        <p class="text-gray-800 font-medium">{{ $record->appointment->patient->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-400">Dokter</h3>
                        <p class="text-gray-800 font-medium">dr. {{ $record->appointment->doctor->user->name ?? '-' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-400">Layanan</h3>
                        <p class="text-gray-800 font-medium">{{ $record->appointment->service->name ?? '-' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-400">Tanggal Appointment</h3>
                        <p class="text-gray-800 font-medium">{{ $record->appointment->appointment_date->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>

                @if($record->blood_pressure || $record->heart_rate || $record->temperature || $record->weight || $record->height)
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Tanda Vital</h2>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @if($record->blood_pressure)
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <p class="text-sm text-gray-400">Tekanan Darah</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $record->blood_pressure }}</p>
                        </div>
                        @endif
                        @if($record->heart_rate)
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <p class="text-sm text-gray-400">Detak Jantung</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $record->heart_rate }} bpm</p>
                        </div>
                        @endif
                        @if($record->temperature)
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <p class="text-sm text-gray-400">Suhu</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $record->temperature }} °C</p>
                        </div>
                        @endif
                        @if($record->weight)
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <p class="text-sm text-gray-400">Berat</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $record->weight }} kg</p>
                        </div>
                        @endif
                        @if($record->height)
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <p class="text-sm text-gray-400">Tinggi</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $record->height }} cm</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Diagnosis</h2>
                    <p class="text-gray-600">{{ $record->diagnosis ?? '-' }}</p>
                </div>

                @if($record->treatment)
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Tindakan</h2>
                    <p class="text-gray-600">{{ $record->treatment }}</p>
                </div>
                @endif

                @if($record->notes)
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Catatan</h2>
                    <p class="text-gray-600">{{ $record->notes }}</p>
                </div>
                @endif

                @if($record->prescriptions && $record->prescriptions->count() > 0)
                <div class="border-t border-gray-100 pt-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Resep Obat</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                                    <th class="px-4 py-3 font-medium">Obat</th>
                                    <th class="px-4 py-3 font-medium">Dosis</th>
                                    <th class="px-4 py-3 font-medium">Frekuensi</th>
                                    <th class="px-4 py-3 font-medium">Durasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($record->prescriptions as $prescription)
                                <tr class="border-b border-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-800">{{ $prescription->medicine_name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $prescription->dosage }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $prescription->frequency }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $prescription->duration }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection