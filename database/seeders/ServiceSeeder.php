<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Konsultasi Dokter Umum',
                'slug' => 'konsultasi-dokter-umum',
                'category' => 'general',
                'description' => 'Konsultasi kesehatan umum dengan dokter profesional. Meliputi pemeriksaan awal, diagnosis, dan resep obat.',
                'price' => 150000,
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Perawatan Gigi',
                'slug' => 'perawatan-gigi',
                'category' => 'dental',
                'description' => 'Perawatan gigi lengkap termasuk scaling, tambal gigi, dan cabut gigi.',
                'price' => 200000,
                'duration' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Konsultasi Anak',
                'slug' => 'konsultasi-anak',
                'category' => 'pediatric',
                'description' => 'Konsultasi kesehatan khusus untuk anak-anak dengan dokter spesialis anak.',
                'price' => 180000,
                'duration' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Cek Kesehatan Rutin',
                'slug' => 'cek-kesehatan-rutin',
                'category' => 'general',
                'description' => 'Pemeriksaan kesehatan rutin meliputi tensi, gula darah, kolesterol, dan asam urat.',
                'price' => 100000,
                'duration' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Perawatan Kulit',
                'slug' => 'perawatan-kulit',
                'category' => 'skin',
                'description' => 'Perawatan kulit untuk berbagai masalah kulit seperti jerawat, alergi, dan infeksi kulit.',
                'price' => 250000,
                'duration' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Vaksinasi',
                'slug' => 'vaksinasi',
                'category' => 'general',
                'description' => 'Layanan vaksinasi untuk anak-anak dan dewasa dengan vaksin berkualitas.',
                'price' => 300000,
                'duration' => 15,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
