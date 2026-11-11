<?php

namespace Tests\Feature;

use App\Models\KoleksiPita;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_menampilkan_ringkasan_dari_data_nyata(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Total koleksi');
        $response->assertSee('PL-020');
        $response->assertSee('Tindakan selesai');
        $response->assertSee('Prioritas berat');
        $this->assertSame(20, KoleksiPita::query()->count());
    }

    public function test_dashboard_menampilkan_keadaan_kosong(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Rak arsip masih kosong');
    }
}
