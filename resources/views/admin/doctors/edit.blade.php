@extends('layouts.app')

@section('title', 'Edit Dokter')

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold font-[Poppins] text-gray-800 mb-8">Edit Dokter</h1>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $doctor->user->name) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('name') border-red-300 @enderror">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $doctor->user->email) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition @error('email') border-red-300 @enderror">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $doctor->user->phone) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Spesialisasi</label>
                        <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition"
                            placeholder="Contoh: Dokter Umum, Spesialis Anak">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-2">Biaya Konsultasi</label>
                        <input type="number" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-300 focus:ring-2 focus:ring-pink-100 outline-none transition">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Layanan</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach($services as $service)
                            <label class="flex items-center space-x-2 p-3 rounded-xl border border-gray-100 hover:bg-pink-50 cursor-pointer transition">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                    class="rounded border-gray-300 text-pink-500 focus:ring-pink-300"
                                    @checked(in_array($service->id, old('services', $doctor->services->pluck('id')->toArray())))>
                                <span class="text-sm text-gray-700">{{ $service->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.doctors') }}" class="px-8 py-3 rounded-xl font-medium border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Batal</a>
                    <button type="submit"
                        class="text-white px-8 py-3 rounded-xl font-semibold transition shadow-md hover:shadow-lg"
                        style="background: linear-gradient(135deg, #FFB6C1, #FF69B4);">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
