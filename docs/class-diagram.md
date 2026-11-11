# Class Diagram: Pita Lestari

Diagram kelas berikut menggambarkan model Eloquent, service transaksi, controller resource, dan Form Request yang dipakai aplikasi. Relasi kartu menunjukkan kardinalitas Eloquent, sedangkan garis putus-putus menunjukkan ketergantungan pemakaian.

```mermaid
classDiagram
    direction TB

    class KategoriFormat {
        <<Model>>
        +int id
        +string nama_format
        +text deskripsi
        +timestamp created_at
        +timestamp updated_at
        +koleksiPita() HasMany
    }

    class KoleksiPita {
        <<Model>>
        +int id
        +string kode_koleksi
        +string nama_koleksi
        +int kategori_format_id
        +int tahun
        +text deskripsi
        +timestamp created_at
        +timestamp updated_at
        +kategoriFormat() BelongsTo
        +detailKondisi() HasOne
        +tindakanRestorasi() BelongsToMany
        +scopeCari(Builder, string) Builder
        +scopeFilterKategori(Builder, int) Builder
        +scopeFilterTingkat(Builder, string) Builder
        +scopeFilterStatus(Builder, string) Builder
        +statusDominan() string
    }

    class DetailKondisi {
        <<Model>>
        +int id
        +int koleksi_pita_id
        +text kondisi_awal
        +enum tingkat_kerusakan
        +text catatan
        +timestamp created_at
        +timestamp updated_at
        +koleksiPita() BelongsTo
    }

    class TindakanRestorasi {
        <<Model>>
        +int id
        +string nama_tindakan
        +text deskripsi
        +timestamp created_at
        +timestamp updated_at
        +koleksiPita() BelongsToMany
    }

    class KoleksiTindakan {
        <<Pivot>>
        +int id
        +int koleksi_pita_id
        +int tindakan_restorasi_id
        +enum status
        +date tanggal_mulai
        +date tanggal_selesai
        +text catatan
    }

    class KoleksiService {
        <<Service>>
        +create(array data) KoleksiPita
        +update(KoleksiPita koleksi, array data) KoleksiPita
        +delete(KoleksiPita koleksi) void
        -sinkronkanTindakan(KoleksiPita koleksi, array tindakan) void
    }

    class KoleksiController {
        <<Controller>>
        +index(Request request) View
        +create() View
        +store(StoreKoleksiRequest request) RedirectResponse
        +show(KoleksiPita koleksi) View
        +edit(KoleksiPita koleksi) View
        +update(UpdateKoleksiRequest request, KoleksiPita koleksi) RedirectResponse
        +destroy(KoleksiPita koleksi) RedirectResponse
    }

    class KategoriFormatController {
        <<Controller>>
        +index(Request request) View
        +store(StoreKategoriRequest request) RedirectResponse
        +edit(KategoriFormat kategoriFormat) View
        +update(UpdateKategoriRequest request, KategoriFormat kategoriFormat) RedirectResponse
        +destroy(KategoriFormat kategoriFormat) RedirectResponse
    }

    class TindakanRestorasiController {
        <<Controller>>
        +index(Request request) View
        +store(StoreTindakanRequest) RedirectResponse
        +edit(TindakanRestorasi) View
        +update(UpdateTindakanRequest, TindakanRestorasi) RedirectResponse
        +destroy(TindakanRestorasi) RedirectResponse
    }

    class StoreKoleksiRequest {
        <<FormRequest>>
        +rules() array
        +after() array
    }

    class UpdateKoleksiRequest {
        <<FormRequest>>
        +rules() array
        +after() array
    }

    KategoriFormat "1" --> "0..*" KoleksiPita : mengelompokkan
    KoleksiPita "1" --> "1" DetailKondisi : memiliki detail
    KoleksiPita "1" --> "0..*" TindakanRestorasi : memilih lewat pivot
    KoleksiPita "1" --> "0..*" KoleksiTindakan : pivot
    TindakanRestorasi "1" --> "0..*" KoleksiTindakan : dipakai pivot

    KoleksiController ..> KoleksiService : memakai
    KoleksiController ..> StoreKoleksiRequest : memvalidasi
    KoleksiController ..> UpdateKoleksiRequest : memvalidasi
    KoleksiService ..> KoleksiPita : menulis
    KoleksiService ..> DetailKondisi : menulis
    KoleksiService ..> KoleksiTindakan : menyinkronkan
    KategoriFormatController ..> KategoriFormat : mengelola
    TindakanRestorasiController ..> TindakanRestorasi : mengelola
```

## Catatan implementasi

- `KoleksiPita` memiliki `hasOne(DetailKondisi)` dan `belongsToMany(TindakanRestorasi)` dengan `withPivot('status', 'tanggal_mulai', 'tanggal_selesai', 'catatan')`.
- `KoleksiService` membungkus penyimpanan koleksi, detail kondisi, dan sinkronisasi pivot dalam `DB::transaction`.
- `StoreKoleksiRequest` dan `UpdateKoleksiRequest` mewarisi aturan dasar dari `KoleksiRequest`, termasuk validasi tanggal per tindakan.
- Controller kategori dan tindakan memakai guard sebelum menghapus data yang masih dipakai.

## Berkas sumber

- Mermaid: `docs/class-diagram.mmd`
- Hasil PNG: `docs/class-diagram.png`
