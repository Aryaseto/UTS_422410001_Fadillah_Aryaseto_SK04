<?php

namespace Database\Factories;

use App\Models\KategoriFormat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KategoriFormat>
 */
class KategoriFormatFactory extends Factory
{
    protected $model = KategoriFormat::class;

    public function definition(): array
    {
        return [
            'nama_format' => ucfirst(fake()->unique()->words(3, true)),
            'deskripsi' => fake()->paragraph(),
        ];
    }
}
