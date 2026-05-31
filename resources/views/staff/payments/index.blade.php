@extends('layouts.staff')

@section('title', 'Pembayaran')
@section('breadcrumb', 'Pembayaran')

@section('content')
<div class="py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="page-title">Pembayaran</h1>
        <span class="text-sm text-gray-400">Pembayaran dicatat melalui halaman appointment</span>
    </div>

    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                        <th class="px-6 py-4 font-medium">Invoice</th>
                        <th class="px-6 py-4 font-medium">Pasien</th>
                        <th class="px-6 py-4 font-medium">Jumlah</th>
                        <th class="px-6 py-4 font-medium">Metode</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">#{{ $payment->invoice_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $payment->appointment->patient->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm font-medium" style="color: #D4AF37;">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($payment->payment_method ?? '-') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($payment->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($payment->status == 'paid') bg-green-100 text-green-700
                                @elseif($payment->status == 'cancelled') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $payment->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-sm font-medium hover:underline" style="color: #D4AF37;">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <p class="text-4xl mb-4">💰</p>
                            <p>Belum ada pembayaran.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $payments->links() }}
    </div>
</div>
@endsection