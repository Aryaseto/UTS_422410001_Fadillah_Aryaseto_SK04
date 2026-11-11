<?php

namespace Database\Seeders;

use App\Models\TindakanRestorasi;
use Illuminate\Database\Seeder;

class TindakanRestorasiSeeder extends Seeder
{
    public function run(): void
    {
        $tindakan = [
            [
                'nama_tindakan' => 'Pembersihan kering',
                'deskripsi' => 'Menyapu debu dan partikel lepas dari permukaan pita serta cangkang menggunakan kain microfiber dan kuas anti-statis.',
            ],
            [
                'nama_tindakan' => 'Pembersihan kepala dan jalur pita',
                'deskripsi' => 'Membersihkan head, capstan, pinch roller, dan guide pada mesin pemutar sebelum pita dijalankan.',
            ],
            [
                'nama_tindakan' => 'Perbaikan sambungan',
                'deskripsi' => 'Menyambung kembali pita yang putus dengan splicing tape dan jig agar sudut potongan tetap lurus.',
            ],
            [
                'nama_tindakan' => 'Penggantian rumah kaset',
                'deskripsi' => 'Memindahkan pita ke cangkang baru ketika rumah lama retak, berubah bentuk, atau pengunciannya tidak lagi rapat.',
            ],
            [
                'nama_tindakan' => 'Penyetelan azimuth',
                'deskripsi' => 'Menyelaraskan kemiringan kepala baca agar sudut pita sesuai standar dan respons frekuensi kembali seimbang.',
            ],
            [
                'nama_tindakan' => 'Pemanggangan pita',
                'deskripsi' => 'Pemanasan terkontrol pada suhu rendah untuk mengurangi lengket akibat hidrolisis sebelum proses transfer.',
            ],
            [
                'nama_tindakan' => 'Relubrikasi pita',
                'deskripsi' => 'Mengaplikasikan pelumas khusus pada pita yang kering agar gesekan dan kehilangan sinyal berkurang.',
            ],
            [
                'nama_tindakan' => 'Remediasi jamur',
                'deskripsi' => 'Membersihkan spora jamur dengan prosedur aman, alat terpisah, dan ventilasi memadai untuk melindungi koleksi lain.',
            ],
            [
                'nama_tindakan' => 'Digitalisasi',
                'deskripsi' => 'Transfer sinyal analog ke berkas digital 24-bit/96 kHz dengan pencatatan tingkat gain dan perangkat yang digunakan.',
            ],
            [
                'nama_tindakan' => 'Penggantian leader tape',
                'deskripsi' => 'Mengganti pita penuntun di awal dan akhir gulungan agar pita tidak tertarik langsung oleh reel atau capstan.',
            ],
        ];

        foreach ($tindakan as $item) {
            TindakanRestorasi::updateOrCreate(
                ['nama_tindakan' => $item['nama_tindakan']],
                ['deskripsi' => $item['deskripsi']]
            );
        }
    }
}
