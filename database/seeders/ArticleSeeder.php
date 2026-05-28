<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@moncheri.id')->first();

        $articles = [
            [
                'title' => 'Tips Menjaga Kesehatan Keluarga di Musim Hujan',
                'slug' => 'tips-menjaga-kesehatan-keluarga-di-musim-hujan',
                'content' => '<p>Musim hujan sering kali membawa berbagai penyakit seperti flu, demam berdarah, dan infeksi saluran pernapasan. Berikut adalah tips untuk menjaga kesehatan keluarga Anda:</p><ul><li>Konsumsi makanan bergizi seimbang</li><li>Istirahat yang cukup</li><li>Olahraga teratur</li><li>Jaga kebersihan lingkungan</li><li>Minum air putih yang cukup</li></ul>',
                'excerpt' => 'Musim hujan sering kali membawa berbagai penyakit. Simak tips menjaga kesehatan keluarga Anda.',
                'category' => 'Kesehatan',
                'author_id' => $admin ? $admin->id : 1,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Pentingnya Pemeriksaan Kesehatan Rutin',
                'slug' => 'pentingnya-pemeriksaan-kesehatan-rutin',
                'content' => '<p>Pemeriksaan kesehatan rutin sangat penting untuk mendeteksi dini berbagai penyakit. Dengan melakukan check-up secara teratur, Anda dapat:</p><ul><li>Mendeteksi penyakit sejak dini</li><li>Memantau kondisi kesehatan</li><li>Mencegah penyakit serius</li><li>Mendapatkan penanganan tepat waktu</li></ul>',
                'excerpt' => 'Pemeriksaan kesehatan rutin sangat penting untuk mendeteksi dini berbagai penyakit.',
                'category' => 'Kesehatan',
                'author_id' => $admin ? $admin->id : 1,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Perawatan Gigi untuk Anak Sejak Dini',
                'slug' => 'perawatan-gigi-untuk-anak-sejak-dini',
                'content' => '<p>Kesehatan gigi anak perlu diperhatikan sejak dini. Berikut panduan perawatan gigi untuk anak:</p><ul><li>Sikat gigi minimal 2 kali sehari</li><li>Gunakan pasta gigi mengandung fluoride</li><li>Kurangi konsumsi makanan manis</li><li>Periksakan gigi ke dokter setiap 6 bulan</li></ul>',
                'excerpt' => 'Kesehatan gigi anak perlu diperhatikan sejak dini. Berikut panduan lengkapnya.',
                'category' => 'Gigi',
                'author_id' => $admin ? $admin->id : 1,
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
