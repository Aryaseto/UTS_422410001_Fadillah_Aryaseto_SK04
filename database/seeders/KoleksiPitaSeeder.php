<?php

namespace Database\Seeders;

use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KoleksiPitaSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = KategoriFormat::query()->pluck('id', 'nama_format');
        $tindakan = TindakanRestorasi::query()->pluck('id', 'nama_tindakan');

        $koleksi = [
            [
                'kode' => 'PL-001',
                'nama' => 'Rekaman Gamelan Ki Nartosabdo, 1974',
                'kategori' => 'Kaset Compact',
                'tahun' => 1974,
                'deskripsi' => 'Rekaman latihan gamelan dari pendopo keluarga di Yogyakarta. Berisi tiga lagu lengkap dengan obrolan para pemain di sela latihan.',
                'kondisi' => 'Cangkang retak pada sudut kanan atas, pita masih tergulung rapi. Terdapat debu pada jendela kaset dan label tulisan tangan mulai pudar.',
                'tingkat' => 'ringan',
                'catatan' => 'Label asli dipertahankan. Salinan digital digunakan untuk akses harian.',
                'tindakan' => [
                    ['Pembersihan kering', 'selesai', '2025-01-14', '2025-01-14', 'Debu dibersihkan dengan kuas anti-statis.'],
                    ['Digitalisasi', 'selesai', '2025-01-20', '2025-01-20', 'Transfer 24-bit/96 kHz, level puncak -6 dB.'],
                ],
            ],
            [
                'kode' => 'PL-002',
                'nama' => 'Siaran RRI: Pidato Kemerdekaan 1966',
                'kategori' => 'Reel-to-Reel 1/4 inci',
                'tahun' => 1966,
                'deskripsi' => 'Rekaman siaran radio upacara peringatan kemerdekaan. Terdapat bagian pidato, doa, dan laporan reporter lapangan.',
                'kondisi' => 'Pita mengeluarkan bau asam dan lengket saat dilepas dari reel. Jamur putih terlihat pada 30 sentimeter pertama. Reel logam berkarat ringan.',
                'tingkat' => 'berat',
                'catatan' => 'Harus dipanggang sebelum diputar. Ruang kerja terpisah untuk mencegah kontaminasi spora.',
                'tindakan' => [
                    ['Remediasi jamur', 'proses', '2025-03-02', null, 'Pembersihan bertahap, alat dipisahkan dari koleksi lain.'],
                    ['Pemanggangan pita', 'rencana', null, null, 'Jadwalkan setelah remediasi selesai.'],
                    ['Digitalisasi', 'rencana', null, null, 'Prioritas tinggi karena kondisi pita rapuh.'],
                ],
            ],
            [
                'kode' => 'PL-003',
                'nama' => 'Demo Band Melati, 1982',
                'kategori' => 'Kaset Compact',
                'tahun' => 1982,
                'deskripsi' => 'Demo empat lagu milik grup musik kampus. Sisi B berisi versi akustik yang tidak pernah dirilis.',
                'kondisi' => 'Pita putus sekitar dua menit dari awal sisi A. Cangkang penyok dan pengunci tidak menutup rapat.',
                'tingkat' => 'sedang',
                'catatan' => 'Sambungan lama perlu dibuka ulang sebelum dipindahkan ke rumah baru.',
                'tindakan' => [
                    ['Perbaikan sambungan', 'rencana', null, null, 'Siapkan splicing tape 2 mm.'],
                    ['Penggantian rumah kaset', 'rencana', null, null, 'Gunakan cangkang donor dengan warna serupa.'],
                ],
            ],
            [
                'kode' => 'PL-004',
                'nama' => 'Master Album Swami, 1991',
                'kategori' => 'Reel-to-Reel 1/2 inci',
                'tahun' => 1991,
                'deskripsi' => 'Master dua belas lagu untuk album studio. Termasuk take alternatif dan catatan produser pada kotak reel.',
                'kondisi' => 'Pita tampak bersih, tetapi suara kanan lebih pelan. Diduga azimuth kepala baca bergeser setelah perpindahan ruang.',
                'tingkat' => 'ringan',
                'catatan' => 'Kotak asli disimpan terpisah karena memuat catatan tangan produser.',
                'tindakan' => [
                    ['Pembersihan kepala dan jalur pita', 'selesai', '2024-11-08', '2024-11-08', 'Head dan capstan dibersihkan sebelum uji putar.'],
                    ['Penyetelan azimuth', 'selesai', '2024-11-09', '2024-11-09', 'Kanal kanan kembali sejajar.'],
                    ['Digitalisasi', 'selesai', '2024-11-12', '2024-11-15', 'Tiga sesi transfer, file per lagu dan file utuh.'],
                ],
            ],
            [
                'kode' => 'PL-005',
                'nama' => 'Catatan Lapangan Ekspedisi Kalimantan, 1988',
                'kategori' => 'Microcassette',
                'tahun' => 1988,
                'deskripsi' => 'Wawancara dengan warga dan perekaman suara hutan selama ekspedisi dua minggu. Sebagian wawancara menggunakan bahasa daerah.',
                'kondisi' => 'Pita terlipat pada menit ketiga. Cangkang kotor oleh tanah kering, tetapi label masih terbaca.',
                'tingkat' => 'sedang',
                'catatan' => 'Perlu transkripsi dan penandaan pembicara setelah digitalisasi.',
                'tindakan' => [
                    ['Pembersihan kering', 'proses', '2025-04-11', null, 'Cangkang dibersihkan lebih dulu, pita belum diputar.'],
                    ['Digitalisasi', 'rencana', null, null, 'Gunakan mesin dengan tension rendah.'],
                ],
            ],
            [
                'kode' => 'PL-006',
                'nama' => 'Koleksi Lagu Anak Bapak Soekito, 1979',
                'kategori' => 'Kaset Compact',
                'tahun' => 1979,
                'deskripsi' => 'Dua belas lagu anak yang dinyanyikan bersama murid sekolah dasar. Rekaman dilakukan di ruang kelas dengan perekam portabel.',
                'kondisi' => 'Pita bersih dan gulungan stabil. Cangkang sedikit kusam, label masih lengkap.',
                'tingkat' => 'ringan',
                'catatan' => 'Koleksi dalam kondisi baik, hanya perlu pembersihan rutin.',
                'tindakan' => [
                    ['Pembersihan kering', 'selesai', '2025-02-01', '2025-02-01', 'Pembersihan rutin sebelum penyimpanan.'],
                ],
            ],
            [
                'kode' => 'PL-007',
                'nama' => 'Rekaman Wayang Kulit Sriwedari, 1970',
                'kategori' => 'Reel-to-Reel 1/4 inci',
                'tahun' => 1970,
                'deskripsi' => 'Pertunjukan wayang kulit semalam suntuk, terdiri dari enam reel. Rekaman mencakup iringan gamelan dan dialog dalang.',
                'kondisi' => 'Tiga reel menunjukkan jamur aktif. Pita lengket dan beberapa lapisan menempel saat digulung. Reel plastik retak pada satu sisi.',
                'tingkat' => 'berat',
                'catatan' => 'Tangani dengan sarung tangan dan masker. Pisahkan dari koleksi lain selama remediasi.',
                'tindakan' => [
                    ['Remediasi jamur', 'proses', '2025-01-05', null, 'Dua dari tiga reel sudah dibersihkan.'],
                    ['Pemanggangan pita', 'rencana', null, null, 'Suhu 54 derajat Celsius, durasi bertahap.'],
                    ['Digitalisasi', 'rencana', null, null, 'Prioritas setelah pita stabil.'],
                ],
            ],
            [
                'kode' => 'PL-008',
                'nama' => 'Mixtape Jalanan Jakarta, 1994',
                'kategori' => 'Kaset Compact',
                'tahun' => 1994,
                'deskripsi' => 'Kompilasi lagu yang direkam dari radio dan dijual di pasar loak. Menyimpan jejak selera musik remaja kota pada 1990-an.',
                'kondisi' => 'Pita putus di dua titik dan cangkang retak pada bagian engsel. Label ditulis dengan spidol pudar.',
                'tingkat' => 'sedang',
                'catatan' => 'Gunakan cangkang donor bening agar label asli tetap terlihat.',
                'tindakan' => [
                    ['Perbaikan sambungan', 'selesai', '2024-12-02', '2024-12-02', 'Dua sambungan dirapikan dengan jig.'],
                    ['Penggantian rumah kaset', 'selesai', '2024-12-03', '2024-12-03', 'Pita dipindahkan tanpa memotong gulungan.'],
                ],
            ],
            [
                'kode' => 'PL-009',
                'nama' => 'Rapat Direksi Pabrik Gula, 1985',
                'kategori' => 'Microcassette',
                'tahun' => 1985,
                'deskripsi' => 'Rekaman rapat direksi membahas rencana perluasan pabrik. Berisi laporan produksi dan perdebatan mengenai lahan tebu.',
                'kondisi' => 'Pita masih berputar normal. Suara latar mendengung, kemungkinan dari kabel mikrofon asli.',
                'tingkat' => 'ringan',
                'catatan' => 'Dengung dapat dikurangi saat pemrosesan digital, bukan saat transfer.',
                'tindakan' => [
                    ['Digitalisasi', 'selesai', '2025-02-17', '2025-02-17', 'Transfer apa adanya, tanpa filter.'],
                ],
            ],
            [
                'kode' => 'PL-010',
                'nama' => 'Konser Amal 1997',
                'kategori' => 'VHS',
                'tahun' => 1997,
                'deskripsi' => 'Rekaman konser amal di aula kota. Menampilkan enam penampil dan sambutan panitia.',
                'kondisi' => 'Gambar bergaris pada 10 menit pertama. Cangkang berdebu dan label stiker terkelupas sebagian.',
                'tingkat' => 'sedang',
                'catatan' => 'Bersihkan jalur pita sebelum mencoba pemutaran berikutnya.',
                'tindakan' => [
                    ['Pembersihan kepala dan jalur pita', 'selesai', '2025-03-20', '2025-03-20', 'Kepala video dan drum dibersihkan.'],
                    ['Digitalisasi', 'proses', '2025-03-22', null, 'Tangkap sinyal melalui capture card, cek drop frame.'],
                ],
            ],
            [
                'kode' => 'PL-011',
                'nama' => 'Master Iklan Radio 1980',
                'kategori' => 'Reel-to-Reel 1/2 inci',
                'tahun' => 1980,
                'deskripsi' => 'Kumpulan jingle dan iklan radio untuk produk rumah tangga. Beberapa naskah iklan disimpan di kotak yang sama.',
                'kondisi' => 'Pita lengket dan mengeluarkan bau asam. Satu reel mengalami distorsi pada lapisan luar.',
                'tingkat' => 'berat',
                'catatan' => 'Jangan diputar sebelum dipanggang. Catat setiap perubahan bentuk pita.',
                'tindakan' => [
                    ['Pemanggangan pita', 'rencana', null, null, 'Jadwalkan dua siklus dengan pendinginan bertahap.'],
                    ['Digitalisasi', 'rencana', null, null, 'Transfer setelah pita stabil maksimal 48 jam.'],
                ],
            ],
            [
                'kode' => 'PL-012',
                'nama' => 'Kaset Pelatihan Bahasa Inggris, 1983',
                'kategori' => 'Kaset Compact',
                'tahun' => 1983,
                'deskripsi' => 'Materi pelatihan bahasa Inggris untuk karyawan hotel. Terdiri dari dialog, latihan pengucapan, dan instruksi tutor.',
                'kondisi' => 'Pita bersih, cangkang utuh. Ada bekas staples pada label yang perlu diangkat hati-hati.',
                'tingkat' => 'ringan',
                'catatan' => 'Staples diangkat agar tidak melukai pita saat kaset dibuka.',
                'tindakan' => [
                    ['Pembersihan kering', 'selesai', '2025-01-28', '2025-01-28', 'Debu dan staples dibersihkan.'],
                ],
            ],
            [
                'kode' => 'PL-013',
                'nama' => 'Dokumentasi Tari Bali, 1990',
                'kategori' => 'U-matic',
                'tahun' => 1990,
                'deskripsi' => 'Dokumentasi lima tarian Bali untuk keperluan pelatihan sanggar. Termasuk wawancara dengan pelatih tari.',
                'kondisi' => 'Pita berdebu dan drum pemutar mengeluarkan suara kasar. Gambar masih muncul, tetapi warna mulai pudar.',
                'tingkat' => 'sedang',
                'catatan' => 'Gunakan mesin U-matic yang baru diservis untuk menghindari kerusakan tambahan.',
                'tindakan' => [
                    ['Pembersihan kepala dan jalur pita', 'proses', '2025-04-02', null, 'Pembersihan drum dilakukan bertahap.'],
                    ['Digitalisasi', 'rencana', null, null, 'Siapkan perangkat capture komposit.'],
                ],
            ],
            [
                'kode' => 'PL-014',
                'nama' => 'Rekaman Fonetik Bahasa Daerah, 1978',
                'kategori' => 'Reel-to-Reel 1/4 inci',
                'tahun' => 1978,
                'deskripsi' => 'Kumpulan rekaman fonetik dari enam penutur bahasa daerah. Setiap reel disertai catatan transkripsi tangan.',
                'kondisi' => 'Pita bersih, gulungan rapi, dan kotak asli masih utuh. Terdapat sedikit debu pada tepi reel.',
                'tingkat' => 'ringan',
                'catatan' => 'Kotak asli menyimpan catatan transkripsi, jangan dipisahkan.',
                'tindakan' => [
                    ['Pembersihan kering', 'selesai', '2024-10-14', '2024-10-14', 'Debu tepi reel dibersihkan.'],
                    ['Digitalisasi', 'selesai', '2024-10-18', '2024-10-25', 'Enam reel ditransfer dan diberi metadata penutur.'],
                ],
            ],
            [
                'kode' => 'PL-015',
                'nama' => 'Album Dangdut Orkes Kendedes, 1986',
                'kategori' => 'Kartrid 8-Track',
                'tahun' => 1986,
                'deskripsi' => 'Album dangdut delapan lagu dalam format kartrid. Kotak plastik asli masih ada, tetapi engselnya patah.',
                'kondisi' => 'Pita macet pada track kedua. Pegas penekan sudah lemah dan lapisan graphit terkelupas.',
                'tingkat' => 'berat',
                'catatan' => 'Bongkar kartrid dengan hati-hati, simpan urutan komponen dalam nampan.',
                'tindakan' => [
                    ['Penggantian rumah kaset', 'rencana', null, null, 'Cari donor kartrid dengan mekanisme serupa.'],
                    ['Perbaikan sambungan', 'proses', '2025-03-15', null, 'Sambungan lama sedang diperiksa.'],
                ],
            ],
            [
                'kode' => 'PL-016',
                'nama' => 'Khotbah dan Ceramah 1992',
                'kategori' => 'Kaset Compact',
                'tahun' => 1992,
                'deskripsi' => 'Kumpulan ceramah keagamaan yang direkam di komunitas. Terdapat sepuluh kaset dengan durasi rata-rata enam puluh menit.',
                'kondisi' => 'Pita bersih dan cangkang utuh. Beberapa label perlu dilembar ulang karena tulisan memudar.',
                'tingkat' => 'ringan',
                'catatan' => 'Buat indeks isi per kaset sebelum digitalisasi.',
                'tindakan' => [
                    ['Digitalisasi', 'selesai', '2025-02-20', '2025-02-28', 'Sepuluh kaset ditransfer dan diberi nama sesuai tanggal ceramah.'],
                ],
            ],
            [
                'kode' => 'PL-017',
                'nama' => 'Soundtrack Film Dokumenter 1989',
                'kategori' => 'DAT (Digital Audio Tape)',
                'tahun' => 1989,
                'deskripsi' => 'Master audio untuk film dokumenter lingkungan. Berisi musik latar, narasi, dan efek suara yang direkam terpisah.',
                'kondisi' => 'Pita dapat dibaca, tetapi muncul blok error pada menit kedelapan. Drum pemutar perlu dibersihkan.',
                'tingkat' => 'sedang',
                'catatan' => 'Lakukan uji baca pada mesin cadangan sebelum transfer penuh.',
                'tindakan' => [
                    ['Pembersihan kepala dan jalur pita', 'proses', '2025-04-06', null, 'Drum dibersihkan, uji baca diulang.'],
                    ['Penyetelan azimuth', 'rencana', null, null, 'Periksa tracking setelah pembersihan.'],
                    ['Digitalisasi', 'rencana', null, null, 'Gunakan dua kali pembacaan untuk pemulihan blok error.'],
                ],
            ],
            [
                'kode' => 'PL-018',
                'nama' => 'Rekaman Latihan Paduan Suara, 1995',
                'kategori' => 'DCC (Digital Compact Cassette)',
                'tahun' => 1995,
                'deskripsi' => 'Latihan paduan suara menjelang lomba nasional. Berisi aransemen vokal dan arahan pelatih.',
                'kondisi' => 'Cangkang retak halus di bagian depan. Pita masih terbaca pada mesin DCC yang tersedia.',
                'tingkat' => 'sedang',
                'catatan' => 'Mesin DCC terbatas, jadwalkan transfer dalam satu sesi.',
                'tindakan' => [
                    ['Pembersihan kering', 'selesai', '2025-01-11', '2025-01-11', 'Cangkang dibersihkan tanpa membuka unit.'],
                    ['Digitalisasi', 'selesai', '2025-01-25', '2025-01-25', 'Transfer berhasil, satu bagian perlu diulang.'],
                ],
            ],
            [
                'kode' => 'PL-019',
                'nama' => 'Arsip Berita TVRI 1993',
                'kategori' => 'U-matic',
                'tahun' => 1993,
                'deskripsi' => 'Tiga kaset berita daerah yang mencakup liputan banjir, pasar tradisional, dan kegiatan sekolah.',
                'kondisi' => 'Jamur terlihat pada dua kaset. Pita berdebu dan cangkang retak pada salah satu sisi.',
                'tingkat' => 'berat',
                'catatan' => 'Pisahkan kaset berjamur. Jangan gunakan mesin yang sama tanpa pembersihan.',
                'tindakan' => [
                    ['Remediasi jamur', 'rencana', null, null, 'Siapkan ruang isolasi dan alat sekali pakai.'],
                    ['Pembersihan kepala dan jalur pita', 'rencana', null, null, 'Bersihkan mesin sebelum dan sesudah setiap kaset.'],
                ],
            ],
            [
                'kode' => 'PL-020',
                'nama' => 'Demo Elcaset Proyek Eksperimental, 1979',
                'kategori' => 'Elcaset',
                'tahun' => 1979,
                'deskripsi' => 'Rekaman eksperimental dengan synthesizer dan rekaman lapangan. Merupakan satu-satunya salinan yang tersisa dari proyek tersebut.',
                'kondisi' => 'Pita bersih, leader tape lepas, cangkang utuh. Mesin pemutar memerlukan kalibrasi ulang.',
                'tingkat' => 'ringan',
                'catatan' => 'Ganti leader sebelum menjalankan pita pada mesin.',
                'tindakan' => [
                    ['Penggantian leader tape', 'selesai', '2025-02-05', '2025-02-05', 'Leader baru dipasang dengan sambungan 45 derajat.'],
                    ['Digitalisasi', 'selesai', '2025-02-08', '2025-02-09', 'Transfer dua sisi, file disimpan dalam dua lokasi.'],
                ],
            ],
        ];

        foreach ($koleksi as $item) {
            DB::transaction(function () use ($item, $kategori, $tindakan) {
                $record = KoleksiPita::updateOrCreate(
                    ['kode_koleksi' => $item['kode']],
                    [
                        'nama_koleksi' => $item['nama'],
                        'kategori_format_id' => $kategori[$item['kategori']],
                        'tahun' => $item['tahun'],
                        'deskripsi' => $item['deskripsi'],
                    ]
                );

                $record->detailKondisi()->updateOrCreate(
                    ['koleksi_pita_id' => $record->id],
                    [
                        'kondisi_awal' => $item['kondisi'],
                        'tingkat_kerusakan' => $item['tingkat'],
                        'catatan' => $item['catatan'],
                    ]
                );

                $pivot = [];
                foreach ($item['tindakan'] as $action) {
                    $pivot[$tindakan[$action[0]]] = [
                        'status' => $action[1],
                        'tanggal_mulai' => $action[2],
                        'tanggal_selesai' => $action[3],
                        'catatan' => $action[4] ?? fake()->sentence(8),
                    ];
                }

                $record->tindakanRestorasi()->sync($pivot);
            });
        }
    }
}
