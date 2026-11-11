<?php

namespace Tests\Feature;

use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    public function test_kategori_dapat_dicari_dan_ditampilkan_dengan_jumlah_koleksi(): void
    {
        $kategori = KategoriFormat::factory()->create([
            'nama_format' => 'Kaset Compact',
            'deskripsi' => 'Format rumah tangga.',
        ]);
        KategoriFormat::factory()->create(['nama_format' => 'VHS']);

        KoleksiPita::factory()->create(['kategori_format_id' => $kategori->id]);

        $this->get('/kategori?q=kaset')
            ->assertOk()
            ->assertSee('Kaset Compact')
            ->assertSee('1 koleksi')
            ->assertDontSee('VHS');
    }

    public function test_kategori_baru_dapat_disimpan(): void
    {
        $response = $this->post('/kategori', [
            'nama_format' => '  MiniDV  ',
            'deskripsi' => 'Format video digital pada kaset mini.',
        ]);

        $response->assertRedirect(route('kategori.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('kategori_format', [
            'nama_format' => 'MiniDV',
        ]);
    }

    public function test_nama_kategori_harus_unik(): void
    {
        KategoriFormat::factory()->create(['nama_format' => 'Kaset Compact']);

        $response = $this->from('/kategori/create')->post('/kategori', [
            'nama_format' => 'Kaset Compact',
        ]);

        $response->assertSessionHasErrors('nama_format');
        $this->assertSame(1, KategoriFormat::query()->where('nama_format', 'Kaset Compact')->count());
    }

    public function test_update_kategori_mengabaikan_nama_sendiri_saat_cek_unik(): void
    {
        $kategori = KategoriFormat::factory()->create(['nama_format' => 'Kaset Compact']);

        $response = $this->put('/kategori/'.$kategori->id, [
            'nama_format' => 'Kaset Compact',
            'deskripsi' => 'Deskripsi baru.',
        ]);

        $response->assertRedirect(route('kategori.index'));
        $this->assertDatabaseHas('kategori_format', [
            'id' => $kategori->id,
            'deskripsi' => 'Deskripsi baru.',
        ]);
    }

    public function test_kategori_yang_masih_dipakai_tidak_dapat_dihapus(): void
    {
        $kategori = KategoriFormat::factory()->create();
        KoleksiPita::factory()->create(['kategori_format_id' => $kategori->id]);

        $this->delete('/kategori/'.$kategori->id)
            ->assertRedirect(route('kategori.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('kategori_format', ['id' => $kategori->id]);
    }

    public function test_kategori_tanpa_koleksi_dapat_dihapus(): void
    {
        $kategori = KategoriFormat::factory()->create();

        $this->delete('/kategori/'.$kategori->id)
            ->assertRedirect(route('kategori.index'));

        $this->assertDatabaseMissing('kategori_format', ['id' => $kategori->id]);
    }
}
