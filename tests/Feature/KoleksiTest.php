<?php

namespace Tests\Feature;

use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KoleksiTest extends TestCase
{
    use RefreshDatabase;

    public function test_daftar_koleksi_dapat_dicari_berdasarkan_kode_dan_nama(): void
    {
        $kategori = KategoriFormat::factory()->create(['nama_format' => 'Kaset Compact']);
        $lain = KategoriFormat::factory()->create(['nama_format' => 'Reel 1/4 inci']);

        KoleksiPita::factory()->create([
            'kode_koleksi' => 'PL-901',
            'nama_koleksi' => 'Gamelan Sriwedari',
            'kategori_format_id' => $kategori->id,
        ]);
        KoleksiPita::factory()->create([
            'kode_koleksi' => 'PL-902',
            'nama_koleksi' => 'Siaran RRI',
            'kategori_format_id' => $lain->id,
        ]);

        $this->get('/koleksi?q=gamelan')
            ->assertOk()
            ->assertSee('Gamelan Sriwedari')
            ->assertDontSee('Siaran RRI');

        $this->get('/koleksi?q=PL-902')
            ->assertOk()
            ->assertSee('Siaran RRI')
            ->assertDontSee('Gamelan Sriwedari');
    }

    public function test_daftar_koleksi_dapat_disaring_berdasarkan_kategori_tingkat_dan_status(): void
    {
        $kategoriA = KategoriFormat::factory()->create(['nama_format' => 'Kaset Compact']);
        $kategoriB = KategoriFormat::factory()->create(['nama_format' => 'VHS']);
        $tindakan = TindakanRestorasi::factory()->create(['nama_tindakan' => 'Digitalisasi']);

        $a = KoleksiPita::factory()->create([
            'kode_koleksi' => 'PL-911',
            'nama_koleksi' => 'Koleksi Berat',
            'kategori_format_id' => $kategoriA->id,
        ]);
        $a->detailKondisi()->create([
            'kondisi_awal' => 'Pita lengket',
            'tingkat_kerusakan' => 'berat',
        ]);
        $a->tindakanRestorasi()->attach($tindakan, ['status' => 'proses', 'tanggal_mulai' => '2026-01-01']);

        $b = KoleksiPita::factory()->create([
            'kode_koleksi' => 'PL-912',
            'nama_koleksi' => 'Koleksi Ringan',
            'kategori_format_id' => $kategoriB->id,
        ]);
        $b->detailKondisi()->create([
            'kondisi_awal' => 'Debu ringan',
            'tingkat_kerusakan' => 'ringan',
        ]);
        $b->tindakanRestorasi()->attach($tindakan, ['status' => 'selesai', 'tanggal_mulai' => '2026-01-01', 'tanggal_selesai' => '2026-01-02']);

        $this->get('/koleksi?'.http_build_query([
            'kategori' => $kategoriA->id,
            'tingkat' => 'berat',
            'status' => 'proses',
        ]))
            ->assertOk()
            ->assertSee('Koleksi Berat')
            ->assertDontSee('Koleksi Ringan');
    }

    public function test_halaman_detail_menampilkan_kondisi_dan_tindakan(): void
    {
        $koleksi = $this->buatKoleksiLengkap();

        $this->get('/koleksi/'.$koleksi->id)
            ->assertOk()
            ->assertSee($koleksi->kode_koleksi)
            ->assertSee('Pita retak pada cangkang')
            ->assertSee('Pembersihan kering')
            ->assertSee('Proses')
            ->assertSee('catatan uji');
    }

    public function test_koleksi_baru_disimpan_beserta_detail_dan_pivot_dalam_satu_transaksi(): void
    {
        $kategori = KategoriFormat::factory()->create();
        $tindakanA = TindakanRestorasi::factory()->create();
        $tindakanB = TindakanRestorasi::factory()->create();

        $response = $this->post('/koleksi', [
            'kode_koleksi' => ' pl-777 ',
            'nama_koleksi' => 'Rekaman Uji Coba',
            'kategori_format_id' => $kategori->id,
            'tahun' => 1991,
            'deskripsi' => 'Deskripsi uji.',
            'detail' => [
                'kondisi_awal' => 'Kondisi awal uji.',
                'tingkat_kerusakan' => 'sedang',
                'catatan' => 'Catatan kondisi uji.',
            ],
            'tindakan' => [
                $tindakanA->id => [
                    'dipilih' => '1',
                    'status' => 'proses',
                    'tanggal_mulai' => '2026-02-01',
                    'catatan' => 'Mulai dikerjakan.',
                ],
                $tindakanB->id => [
                    'dipilih' => '0',
                    'status' => 'rencana',
                ],
            ],
        ]);

        $koleksi = KoleksiPita::query()->where('kode_koleksi', 'PL-777')->firstOrFail();

        $response->assertRedirect(route('koleksi.show', $koleksi));
        $this->assertSame('Rekaman Uji Coba', $koleksi->nama_koleksi);
        $this->assertDatabaseHas('detail_kondisi', [
            'koleksi_pita_id' => $koleksi->id,
            'tingkat_kerusakan' => 'sedang',
        ]);
        $this->assertDatabaseHas('koleksi_tindakan', [
            'koleksi_pita_id' => $koleksi->id,
            'tindakan_restorasi_id' => $tindakanA->id,
            'status' => 'proses',
        ]);
        $this->assertDatabaseMissing('koleksi_tindakan', [
            'koleksi_pita_id' => $koleksi->id,
            'tindakan_restorasi_id' => $tindakanB->id,
        ]);
    }

    public function test_validasi_menolak_koleksi_tanpa_kondisi_awal(): void
    {
        $kategori = KategoriFormat::factory()->create();

        $response = $this->from('/koleksi/create')->post('/koleksi', [
            'kode_koleksi' => 'PL-778',
            'nama_koleksi' => 'Tanpa Kondisi',
            'kategori_format_id' => $kategori->id,
            'detail' => [
                'tingkat_kerusakan' => 'ringan',
            ],
        ]);

        $response->assertRedirect('/koleksi/create');
        $response->assertSessionHasErrors('detail.kondisi_awal');
        $this->assertDatabaseMissing('koleksi_pita', ['kode_koleksi' => 'PL-778']);
    }

    public function test_status_selesai_mewajibkan_tanggal_mulai_dan_tanggal_selesai(): void
    {
        $kategori = KategoriFormat::factory()->create();
        $tindakan = TindakanRestorasi::factory()->create();

        $response = $this->from('/koleksi/create')->post('/koleksi', [
            'kode_koleksi' => 'PL-779',
            'nama_koleksi' => 'Tanggal Tidak Lengkap',
            'kategori_format_id' => $kategori->id,
            'detail' => [
                'kondisi_awal' => 'Kondisi uji.',
                'tingkat_kerusakan' => 'ringan',
            ],
            'tindakan' => [
                $tindakan->id => [
                    'dipilih' => '1',
                    'status' => 'selesai',
                ],
            ],
        ]);

        $response->assertSessionHasErrors([
            'tindakan.'.$tindakan->id.'.tanggal_mulai',
            'tindakan.'.$tindakan->id.'.tanggal_selesai',
        ]);
    }

    public function test_update_menyinkronkan_pivot_tindakan_dan_menjaga_kode_sendiri(): void
    {
        $koleksi = $this->buatKoleksiLengkap();
        $tindakanBaru = TindakanRestorasi::factory()->create(['nama_tindakan' => 'Digitalisasi']);
        $tindakanLama = TindakanRestorasi::query()->firstOrFail();

        $response = $this->put('/koleksi/'.$koleksi->id, [
            'kode_koleksi' => $koleksi->kode_koleksi,
            'nama_koleksi' => 'Nama Setelah Sunting',
            'kategori_format_id' => $koleksi->kategori_format_id,
            'tahun' => 1998,
            'deskripsi' => 'Deskripsi setelah sunting.',
            'detail' => [
                'kondisi_awal' => 'Kondisi setelah sunting.',
                'tingkat_kerusakan' => 'berat',
                'catatan' => 'Catatan baru.',
            ],
            'tindakan' => [
                $tindakanBaru->id => [
                    'dipilih' => '1',
                    'status' => 'rencana',
                    'catatan' => 'Rencana baru.',
                ],
            ],
        ]);

        $response->assertRedirect(route('koleksi.show', $koleksi));
        $this->assertDatabaseHas('koleksi_pita', [
            'id' => $koleksi->id,
            'nama_koleksi' => 'Nama Setelah Sunting',
            'tahun' => 1998,
        ]);
        $this->assertDatabaseHas('detail_kondisi', [
            'koleksi_pita_id' => $koleksi->id,
            'tingkat_kerusakan' => 'berat',
        ]);
        $this->assertDatabaseMissing('koleksi_tindakan', [
            'koleksi_pita_id' => $koleksi->id,
            'tindakan_restorasi_id' => $tindakanLama->id,
        ]);
        $this->assertDatabaseHas('koleksi_tindakan', [
            'koleksi_pita_id' => $koleksi->id,
            'tindakan_restorasi_id' => $tindakanBaru->id,
        ]);
    }

    public function test_hapus_koleksi_ikut_menghapus_detail_dan_pivot(): void
    {
        $koleksi = $this->buatKoleksiLengkap();

        $this->delete('/koleksi/'.$koleksi->id)
            ->assertRedirect(route('koleksi.index'));

        $this->assertDatabaseMissing('koleksi_pita', ['id' => $koleksi->id]);
        $this->assertDatabaseMissing('detail_kondisi', ['koleksi_pita_id' => $koleksi->id]);
        $this->assertDatabaseMissing('koleksi_tindakan', ['koleksi_pita_id' => $koleksi->id]);
    }

    private function buatKoleksiLengkap(): KoleksiPita
    {
        $kategori = KategoriFormat::factory()->create();
        $tindakan = TindakanRestorasi::factory()->create(['nama_tindakan' => 'Pembersihan kering']);

        $koleksi = KoleksiPita::factory()->create([
            'kode_koleksi' => 'PL-'.fake()->unique()->numerify('9##'),
            'kategori_format_id' => $kategori->id,
        ]);

        $koleksi->detailKondisi()->create([
            'kondisi_awal' => 'Pita retak pada cangkang',
            'tingkat_kerusakan' => 'sedang',
            'catatan' => 'Perlu rumah pengganti.',
        ]);

        $koleksi->tindakanRestorasi()->attach($tindakan, [
            'status' => 'proses',
            'tanggal_mulai' => '2026-01-05',
            'catatan' => 'catatan uji',
        ]);

        return $koleksi;
    }
}
