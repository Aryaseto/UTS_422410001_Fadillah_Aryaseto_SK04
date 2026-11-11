<?php

namespace Tests\Feature;

use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use App\Models\TindakanRestorasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TindakanTest extends TestCase
{
    use RefreshDatabase;

    public function test_tindakan_dapat_dicari_dan_menampilkan_jumlah_pemakaian(): void
    {
        $tindakan = TindakanRestorasi::factory()->create([
            'nama_tindakan' => 'Pembersihan kering',
            'deskripsi' => 'Membersihkan debu.',
        ]);
        TindakanRestorasi::factory()->create(['nama_tindakan' => 'Digitalisasi']);

        $koleksi = KoleksiPita::factory()->create(['kategori_format_id' => KategoriFormat::factory()]);
        $koleksi->tindakanRestorasi()->attach($tindakan, ['status' => 'rencana']);

        $this->get('/tindakan?q=bersih')
            ->assertOk()
            ->assertSee('Pembersihan kering')
            ->assertSee('1 koleksi')
            ->assertDontSee('Digitalisasi');
    }

    public function test_tindakan_baru_dapat_disimpan(): void
    {
        $response = $this->post('/tindakan', [
            'nama_tindakan' => '  Uji putar  ',
            'deskripsi' => 'Memutar pita pada mesin uji.',
        ]);

        $response->assertRedirect(route('tindakan.index'));
        $this->assertDatabaseHas('tindakan_restorasi', ['nama_tindakan' => 'Uji putar']);
    }

    public function test_nama_tindakan_harus_unik(): void
    {
        TindakanRestorasi::factory()->create(['nama_tindakan' => 'Digitalisasi']);

        $this->from('/tindakan/create')->post('/tindakan', [
            'nama_tindakan' => 'Digitalisasi',
        ])->assertSessionHasErrors('nama_tindakan');
    }

    public function test_update_tindakan_mengabaikan_nama_sendiri(): void
    {
        $tindakan = TindakanRestorasi::factory()->create(['nama_tindakan' => 'Digitalisasi']);

        $this->put('/tindakan/'.$tindakan->id, [
            'nama_tindakan' => 'Digitalisasi',
            'deskripsi' => 'Deskripsi baru.',
        ])->assertRedirect(route('tindakan.index'));

        $this->assertDatabaseHas('tindakan_restorasi', [
            'id' => $tindakan->id,
            'deskripsi' => 'Deskripsi baru.',
        ]);
    }

    public function test_tindakan_yang_terpasang_pada_koleksi_tidak_dapat_dihapus(): void
    {
        $tindakan = TindakanRestorasi::factory()->create();
        $koleksi = KoleksiPita::factory()->create(['kategori_format_id' => KategoriFormat::factory()]);
        $koleksi->tindakanRestorasi()->attach($tindakan, ['status' => 'rencana']);

        $this->delete('/tindakan/'.$tindakan->id)
            ->assertRedirect(route('tindakan.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('tindakan_restorasi', ['id' => $tindakan->id]);
    }

    public function test_tindakan_tanpa_pemakaian_dapat_dihapus(): void
    {
        $tindakan = TindakanRestorasi::factory()->create();

        $this->delete('/tindakan/'.$tindakan->id)
            ->assertRedirect(route('tindakan.index'));

        $this->assertDatabaseMissing('tindakan_restorasi', ['id' => $tindakan->id]);
    }
}
