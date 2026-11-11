<?php

namespace Database\Seeders;

use App\Models\KategoriFormat;
use Illuminate\Database\Seeder;

class KategoriFormatSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama_format' => 'Kaset Compact',
                'deskripsi' => 'Pita magnetik 1/8 inci di dalam cangkang plastik. Format rumah tangga paling umum pada 1970 sampai 1990-an, banyak dipakai untuk mixtape, dokumentasi keluarga, dan master demo.',
            ],
            [
                'nama_format' => 'Reel-to-Reel 1/4 inci',
                'deskripsi' => 'Pita gulungan terbuka berukuran 1/4 inci. Umum dipakai studio radio, arsip pemerintah, dan rekaman lapangan dengan durasi panjang.',
            ],
            [
                'nama_format' => 'Reel-to-Reel 1/2 inci',
                'deskripsi' => 'Pita gulungan lebar untuk rekaman multitrack dan master album. Memerlukan mesin dengan jalur pita khusus serta ruang penyimpanan bersuhu stabil.',
            ],
            [
                'nama_format' => 'Kartrid 8-Track',
                'deskripsi' => 'Kartrid dengan pita loop tanpa akhir, populer di mobil Amerika pada 1965 sampai 1980. Mekanisme pegas internal sering menjadi titik kerusakan.',
            ],
            [
                'nama_format' => 'Microcassette',
                'deskripsi' => 'Kaset mini untuk diktafon, wawancara lapangan, dan catatan rapat. Cangkang kecil membuat pita rentan terlipat saat mekanisme mesin kotor.',
            ],
            [
                'nama_format' => 'DAT (Digital Audio Tape)',
                'deskripsi' => 'Pita digital 4 mm untuk master dan arsip akhir 1980-an. Sinyal disimpan secara digital, tetapi mekanisme drum pemutar sangat sensitif terhadap debu.',
            ],
            [
                'nama_format' => 'DCC (Digital Compact Cassette)',
                'deskripsi' => 'Kaset digital yang masih kompatibel dengan pemutar analog. Produksi singkat pada 1990-an membuat suku cadang dan mesin pemutar kini langka.',
            ],
            [
                'nama_format' => 'Elcaset',
                'deskripsi' => 'Format pita 1/4 inci di dalam kaset besar, diproduksi singkat pada 1976 sampai 1980. Kualitas audio tinggi dengan populasi mesin yang sangat terbatas.',
            ],
            [
                'nama_format' => 'VHS',
                'deskripsi' => 'Pita video VHS yang menyimpan audio linier dan hi-fi. Sering menjadi satu-satunya salinan dokumentasi acara, siaran lokal, dan arsip keluarga.',
            ],
            [
                'nama_format' => 'U-matic',
                'deskripsi' => 'Kaset video profesional 3/4 inci untuk produksi siaran televisi. Cangkang besar dan jalur pita panjang membutuhkan pembersihan bertahap.',
            ],
        ];

        foreach ($kategori as $item) {
            KategoriFormat::updateOrCreate(
                ['nama_format' => $item['nama_format']],
                ['deskripsi' => $item['deskripsi']]
            );
        }
    }
}
