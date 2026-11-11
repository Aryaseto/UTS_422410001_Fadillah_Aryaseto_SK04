<?php

namespace Database\Factories;

use App\Models\KategoriFormat;
use App\Models\KoleksiPita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KoleksiPita>
 */
class KoleksiPitaFactory extends Factory
{
    protected $model = KoleksiPita::class;

    public function definition(): array
    {
        $tahun = fake()->numberBetween(1958, 2004);

        return [
            'kode_koleksi' => 'PL-'.fake()->unique()->numerify('####'),
            'nama_koleksi' => ucfirst(fake()->words(4, true)),
            'kategori_format_id' => KategoriFormat::factory(),
            'tahun' => $tahun,
            'deskripsi' => fake()->paragraph(),
        ];
    }
}
