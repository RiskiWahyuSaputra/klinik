@extends('layouts.app')

@section('title', 'Kelola Jadwal Dokter')

@section('content')
<div class="py-8">
    <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Kelola Jadwal Dokter</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800">Jadwal Tersedia</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left text-sm text-gray-500 border-b border-gray-100">
                                <th class="px-6 py-4 font-medium">Dokter</th>
                                <th class="px-6 py-4 font-medium">Hari</th>
                                <th class="px-6 py-4 font-medium">Jam Mulai</th>
                                <th class="px-6 py-4 font-medium">Jam Selesai</th>
                                <th class="px-6 py-4 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                            <tr class="border-b border-gray-50 hover:bg-pink-50/50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">dr. {{ $schedule->doctor->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    @php
                                        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                    @endphp
                                    {{ $days[$schedule->day_of_week] ?? $schedule->day_of_week }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->start_time }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $schedule->end_time }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    <p class="text-4xl mb-4">🗓️</p>
                                    <p>Belum ada jadwal.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">
                {{ $schedules->links() }}
            </div>
        </div>

        <div>
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Tambah Jadwal Baru</h2>

                <form method="POST" action="{{ route('admin.schedules.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Dokter</label>
                        <select name="doctor_id" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('doctor_id') border-red-300 @enderror">
                            <option value="">Pilih Dokter</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" @selected(old('doctor_id') == $doctor->id)>
                                dr. {{ $doctor->user->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Hari</label>
                            <select name="day_of_week" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('day_of_week') border-red-300 @enderror">
                                <option value="">Pilih Hari</option>
                                <option value="1" @selected(old('day_of_week') == 1)>Senin</option>
                                <option value="2" @selected(old('day_of_week') == 2)>Selasa</option>
                                <option value="3" @selected(old('day_of_week') == 3)>Rabu</option>
                                <option value="4" @selected(old('day_of_week') == 4)>Kamis</option>
                                <option value="5" @selected(old('day_of_week') == 5)>Jumat</option>
                                <option value="6" @selected(old('day_of_week') == 6)>Sabtu</option>
                                <option value="0" @selected(old('day_of_week') == 0)>Minggu</option>
                            </select>
                        @error('day_of_week') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">Jam Mulai</label>
                            <input type="time" name="start_time" value="{{ old('start_time', '08:00') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('start_time') border-red-300 @enderror">
                            @error('start_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">Jam Selesai</label>
                            <input type="time" name="end_time" value="{{ old('end_time', '16:00') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('end_time') border-red-300 @enderror">
                            @error('end_time') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full text-white py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                        Tambah Jadwal
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection