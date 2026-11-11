# Pita Lestari

Aplikasi pendataan dan restorasi koleksi pita rekaman analog. Dibangun dengan Laravel 12, MySQL, Tailwind CSS 4, dan Blade component.

Studi kasus SK04, UTS mata kuliah Perancangan dan Pemrograman Web Lanjut.

| Keterangan | Isi |
|---|---|
| Nama | Fadillah Aryaseto |
| NIM | 422410001 |
| Nama repository | `UTS_422410001_Fadillah_Aryaseto_SK04` |
| Studi kasus | SK04, Restorasi Pita Analog |
| Framework | Laravel 12 |
| Database | MySQL |
| Tema | Retro analog, hangat, tekstur kertas label dan cangkang kaset |

Repository: `UTS_422410001_Fadillah_Aryaseto_SK04`.

## Daftar isi

- [Fitur](#fitur)
- [Tumpukan teknologi](#tumpukan-teknologi)
- [Struktur folder](#struktur-folder)
- [Rancangan database](#rancangan-database)
- [Relasi Eloquent](#relasi-eloquent)
- [Diagram](#diagram)
- [Instalasi](#instalasi)
- [Menjalankan aplikasi](#menjalankan-aplikasi)
- [Alur pencarian dan filter](#alur-pencarian-dan-filter)
- [Transaksi dan validasi](#transaksi-dan-validasi)
- [Pengujian](#pengujian)
- [Perintah berguna](#perintah-berguna)
- [Pemecahan masalah](#pemecahan-masalah)
- [Catatan desain](#catatan-desain)
- [Catatan data](#catatan-data)

## Fitur

- Dashboard ringkasan: jumlah koleksi, kategori, master tindakan, koleksi rusak berat, persentase tindakan selesai, sebaran format, antrean proses, dan koleksi terbaru.
- CRUD Kategori Format: index, create, store, edit, update, destroy, dengan pencarian nama format dan guard hapus saat masih dipakai koleksi.
- CRUD Koleksi Pita: satu formulir memuat identitas koleksi, detail kondisi awal, dan pilihan tindakan restorasi beserta status dan tanggalnya.
- CRUD Tindakan Restorasi: master tindakan dengan pencarian dan guard hapus saat masih terpasang pada koleksi.
- Pencarian koleksi berdasarkan kode atau nama.
- Filter koleksi berdasarkan kategori format, tingkat kerusakan, dan status tindakan. Filter dapat digabung, ditampilkan sebagai chip, dan dihapus satu per satu.
- Halaman detail koleksi: kondisi awal, tingkat kerusakan, catatan pemeriksa, daftar tindakan dengan status, tanggal mulai, tanggal selesai, dan catatan tindakan.
- Komponen Blade: layout, partial, dan component yang dapat dipakai ulang.
- Antarmuka responsif: sidebar geser pada layar kecil, tabel adaptif, dan tata letak satu kolom di bawah breakpoint menengah.
- Dialog konfirmasi hapus memakai elemen `dialog` sehingga tetap dapat ditutup dengan tombol Escape dan tetap dapat dipakai dengan keyboard.
- Tampilan keadaan kosong, validasi isian, dan pesan flash.

## Tumpukan teknologi

- Laravel 12, PHP 8.2 atau lebih baru
- MySQL 8 atau lebih baru
- Tailwind CSS 4 melalui Vite
- Blade component, partial, dan layout
- Fonta yang disimpan sendiri: Bitter, IBM Plex Sans, IBM Plex Mono
- Ikon Phosphor (lisensi MIT), disimpan di `resources/icons`
- Mermaid CLI untuk membuat diagram PNG

## Struktur folder

```
.
├── app
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── DashboardController.php
│   │   │   ├── KategoriFormatController.php
│   │   │   ├── KoleksiController.php
│   │   │   └── TindakanRestorasiController.php
│   │   └── Requests
│   │       ├── KoleksiRequest.php
│   │       ├── StoreKategoriRequest.php
│   │       ├── StoreKoleksiRequest.php
│   │       ├── StoreTindakanRequest.php
│   │       ├── UpdateKategoriRequest.php
│   │       ├── UpdateKoleksiRequest.php
│   │       └── UpdateTindakanRequest.php
│   ├── Models
│   │   ├── DetailKondisi.php
│   │   ├── KategoriFormat.php
│   │   ├── KoleksiPita.php
│   │   └── TindakanRestorasi.php
│   └── Services
│       └── KoleksiService.php
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── docs
│   ├── class-diagram.md
│   ├── class-diagram.mmd
│   ├── class-diagram.png
│   ├── erd.md
│   ├── erd.mmd
│   └── erd.png
├── lang/id/validation.php
├── resources
│   ├── css/app.css
│   ├── icons
│   ├── js/app.js
│   └── views
│       ├── components
│       ├── koleksi
│       ├── kategori
│       ├── tindakan
│       ├── layouts
│       ├── partials
│       └── vendor/pagination
├── routes/web.php
└── tests/Feature
```

## Rancangan database

| Tabel | Peran | Kolom penting |
|---|---|---|
| `kategori_format` | kategori | `nama_format` unik, `deskripsi` |
| `koleksi_pita` | data utama | `kode_koleksi` unik, `nama_koleksi`, `kategori_format_id`, `tahun`, `deskripsi` |
| `detail_kondisi` | detail satu ke satu | `koleksi_pita_id` unik, `kondisi_awal`, `tingkat_kerusakan`, `catatan` |
| `tindakan_restorasi` | master pilihan jamak | `nama_tindakan` unik, `deskripsi` |
| `koleksi_tindakan` | pivot banyak ke banyak | `koleksi_pita_id`, `tindakan_restorasi_id`, `status`, `tanggal_mulai`, `tanggal_selesai`, `catatan` |

Nilai enum:

- `detail_kondisi.tingkat_kerusakan`: `ringan`, `sedang`, `berat`
- `koleksi_tindakan.status`: `rencana`, `proses`, `selesai`

Constraint penting:

- `kode_koleksi`, `nama_format`, dan `nama_tindakan` unik.
- `detail_kondisi.koleksi_pita_id` unik karena relasi satu ke satu.
- Kombinasi `(koleksi_pita_id, tindakan_restorasi_id)` unik pada tabel pivot.
- Foreign key kategori memakai `RESTRICT` agar kategori yang masih dipakai tidak terhapus diam-diam.
- Foreign key detail dan pivot memakai `CASCADE` agar penghapusan koleksi tidak meninggalkan data yatim.

## Relasi Eloquent

- `KategoriFormat` `hasMany` `KoleksiPita`.
- `KoleksiPita` `belongsTo` `KategoriFormat`.
- `KoleksiPita` `hasOne` `DetailKondisi`.
- `KoleksiPita` `belongsToMany` `TindakanRestorasi` dengan `withPivot('status', 'tanggal_mulai', 'tanggal_selesai', 'catatan')`.
- `DetailKondisi` `belongsTo` `KoleksiPita`.
- `TindakanRestorasi` `belongsToMany` `KoleksiPita` dengan `withPivot` yang sama.

## Diagram

Folder `docs` berisi sumber Mermaid dan hasil PNG:

- `docs/class-diagram.md`, `docs/class-diagram.mmd`, dan `docs/class-diagram.png`
- `docs/erd.md`, `docs/erd.mmd`, dan `docs/erd.png`

Membuat ulang diagram PNG setelah mengubah file `.mmd`:

```bash
npm install
npm run docs:diagrams
```

Perintah tersebut menjalankan `mmdc` dari paket `@mermaid-js/mermaid-cli`:

```bash
mmdc -i docs/class-diagram.mmd -o docs/class-diagram.png -b "#FAF3E2" -s 2
mmdc -i docs/erd.mmd -o docs/erd.png -b "#FAF3E2" -s 2
```

Bila `mmdc` belum tersedia secara global, pakai `npx`:

```bash
npx -y @mermaid-js/mermaid-cli -i docs/class-diagram.mmd -o docs/class-diagram.png -b "#FAF3E2" -s 2
npx -y @mermaid-js/mermaid-cli -i docs/erd.mmd -o docs/erd.png -b "#FAF3E2" -s 2
```

## Instalasi

Prasyarat: PHP 8.2 atau lebih baru, Composer 2, Node.js 18 atau lebih baru, dan MySQL 8 atau lebih baru. Ekstensi PHP yang dibutuhkan: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`.

1. Siapkan proyek.

```bash
git clone <url-repository-anda> UTS_422410001_Fadillah_Aryaseto_SK04
cd UTS_422410001_Fadillah_Aryaseto_SK04
composer install
```

2. Siapkan berkas lingkungan.

```bash
cp .env.example .env
php artisan key:generate
```

3. Buat database MySQL.

```bash
mysql -uroot -p -e "CREATE DATABASE uts_sk04_pita_lestari CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

4. Sesuaikan koneksi pada `.env`.

```dotenv
APP_NAME="Pita Lestari"
APP_LOCALE=id
APP_FAKER_LOCALE=id_ID
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uts_sk04_pita_lestari
DB_USERNAME=root
DB_PASSWORD=
```

5. Jalankan migrasi dan seeder.

```bash
php artisan migrate --seed
```

6. Pasang dan bangun aset frontend.

```bash
npm install
npm run build
```

## Menjalankan aplikasi

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000`.

Untuk pengembangan dengan hot reload Vite, jalankan dua terminal:

```bash
php artisan serve
```

```bash
npm run dev
```

Rute utama:

| Rute | Nama | Keterangan |
|---|---|---|
| `GET /` | `dashboard` | Ringkasan dan koleksi terbaru |
| `GET /koleksi` | `koleksi.index` | Daftar, pencarian, dan filter |
| `GET /koleksi/create` | `koleksi.create` | Formulir koleksi baru |
| `GET /koleksi/{koleksi}` | `koleksi.show` | Lembar detail koleksi |
| `GET /kategori` | `kategori.index` | Daftar kategori format |
| `GET /tindakan` | `tindakan.index` | Daftar master tindakan |

## Alur pencarian dan filter

Halaman daftar koleksi memakai query builder Eloquent melalui scope pada model `KoleksiPita`:

- `scopeCari` mencari kecocokan `kode_koleksi` atau `nama_koleksi` memakai `LIKE`.
- `scopeFilterKategori` memfilter `kategori_format_id`.
- `scopeFilterTingkat` memakai `whereHas('detailKondisi')`.
- `scopeFilterStatus` memakai `whereHas('tindakanRestorasi')` dan kondisi kolom pivot `koleksi_tindakan.status`.
- Hasil diurutkan dari data terbaru, lalu id terbesar sebagai penentu urutan, dan dipaginasi sembilan kartu per halaman dengan `withQueryString()` agar filter tetap terbawa.

Contoh permintaan:

```
/koleksi?q=gamelan&kategori=1&tingkat=berat&status=proses
```

## Transaksi dan validasi

`App\Services\KoleksiService` menangani penyimpanan koleksi, detail kondisi, dan pivot tindakan di dalam `DB::transaction`:

- `create` menyimpan koleksi, membuat detail kondisi, lalu menyinkronkan pivot.
- `update` memperbarui koleksi, memakai `updateOrCreate` untuk detail, lalu menyinkronkan pivot dengan `sync` sehingga tindakan yang dilepas dari formulir ikut terhapus dari pivot.
- `delete` melepas pivot, menghapus detail, lalu menghapus koleksi.
- `sinkronkanTindakan` hanya memproses tindakan yang dicentang dan mengubah tanggal kosong menjadi `null`.

Validasi memakai Form Request:

- `StoreKoleksiRequest` dan `UpdateKoleksiRequest` mewarisi aturan dasar dari `KoleksiRequest`.
- Aturan mencakup kode unik, kategori harus ada, tahun pada rentang wajar, kondisi awal wajib, tingkat kerusakan harus salah satu enum, serta tanggal per tindakan.
- Validasi lanjutan pada `after()` memastikan status wajib untuk tindakan yang dipilih, status `proses` dan `selesai` wajib punya tanggal mulai, status `selesai` wajib punya tanggal selesai, dan tanggal selesai tidak mendahului tanggal mulai.
- `StoreKategoriRequest`, `UpdateKategoriRequest`, `StoreTindakanRequest`, dan `UpdateTindakanRequest` menangani master data dan memakai aturan unik yang mengabaikan id sendiri saat pembaruan.

## Pengujian

```bash
php artisan test
```

Cakupan pengujian:

- Ringkasan dashboard dari data hasil seeder dan keadaan kosong.
- Pencarian koleksi berdasarkan kode dan nama.
- Filter berdasarkan kategori, tingkat kerusakan, dan status tindakan secara gabungan.
- Halaman detail menampilkan kondisi dan tindakan.
- Penyimpanan koleksi baru beserta detail dan pivot.
- Validasi kondisi awal wajib dan aturan tanggal pada tindakan.
- Pembaruan koleksi dengan sinkronisasi pivot dan pengecekan kode unik.
- Penghapusan koleksi beserta detail dan pivot.
- CRUD kategori dan tindakan, termasuk penolakan hapus saat data masih dipakai.

Pengujian memakai SQLite in-memory melalui `phpunit.xml`, sehingga tidak mengubah database MySQL pengembangan.

## Perintah berguna

```bash
php artisan migrate:fresh --seed   # bangun ulang skema dan isi data dummy
php artisan route:list             # lihat seluruh rute
php artisan view:clear             # bersihkan cache tampilan
./vendor/bin/pint                  # rapikan gaya kode PHP
npm run build                      # bangun aset produksi
npm run docs:diagrams              # buat ulang PNG diagram
```

## Pemecahan masalah

- Vite manifest tidak ditemukan: jalankan `npm install` lalu `npm run build`, atau jalankan `npm run dev` saat pengembangan.
- Koneksi MySQL ditolak: pastikan layanan MySQL aktif dan nilai `DB_*` pada `.env` benar.
- Tabel tidak ditemukan: jalankan `php artisan migrate:fresh --seed`.
- Perubahan tampilan tidak muncul: jalankan `php artisan view:clear` dan bangun ulang aset.
- `mmdc` tidak ditemukan: gunakan `npx -y @mermaid-js/mermaid-cli` seperti pada bagian Diagram.
- Diagram gagal karena Chromium: jalankan `npx playwright install chromium` lalu ulangi perintah `mmdc`.

## Catatan desain

Arah visual: ruang arsip analog, dengan dial ENERGY 2 / RHYTHM 2 / MOTION 1.

- Palet paper, tan, sage, dan rust diambil dari kertas label, pita magnetik, dan sampul kaset. Rust menjadi satu aksen untuk peringatan dan tindakan penting.
- Bitter dipakai untuk judul karena menyerupai huruf cetak pada label arsip. IBM Plex Sans menjaga keterbacaan isi, sedangkan IBM Plex Mono dipakai untuk kode, tanggal, dan label teknisi.
- Border tebal dan hard shadow meniru tumpukan kartu katalog dan kotak kaset, sekaligus menandai elevasi tanpa efek glow.
- Tekstur noise dan garis ledger halus memberi kesan kertas, bukan dekorasi generik.
- Ikon Phosphor dipilih sesuai objek arsip: kaset, pita, kunci pas, corong, dan label.
- Gerak dibatasi pada hover, transisi sidebar, dan dialog agar terasa seperti membuka kotak arsip, bukan animasi dekoratif.
- Setiap angka di dashboard dihitung dari database. Data seeder bersifat fiktif dan dijelaskan pada bagian berikut.

## Catatan data

Seluruh data pada seeder bersifat fiktif dan dibuat hanya untuk demonstrasi. Seeder menyediakan 10 kategori format, 10 tindakan restorasi, dan 20 koleksi pita beserta detail kondisi dan pivot tindakan yang bervariasi. Aplikasi ini belum memakai autentikasi karena fokus UTS berada pada CRUD, relasi, validasi, pencarian, dan filter.
