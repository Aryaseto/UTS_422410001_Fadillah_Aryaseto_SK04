<?php

namespace Database\Factories;

use App\Models\DetailKondisi;
use App\Models\KoleksiPita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DetailKondisi>
 */
class DetailKondisiFactory extends Factory
{
    protected $model = DetailKondisi::class;

    public function definition(): array
    {
        return [
            'koleksi_pita_id' => KoleksiPita::factory(),
            'kondisi_awal' => fake()->sentence(14),
            'tingkat_kerusakan' => fake()->randomElement(['ringan', 'sedang', 'berat']),
            'catatan' => fake()->optional()->sentence(),
        ];
    }
}
