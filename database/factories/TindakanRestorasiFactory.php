<?php

namespace Database\Factories;

use App\Models\TindakanRestorasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TindakanRestorasi>
 */
class TindakanRestorasiFactory extends Factory
{
    protected $model = TindakanRestorasi::class;

    public function definition(): array
    {
        return [
            'nama_tindakan' => ucfirst(fake()->unique()->words(3, true)),
            'deskripsi' => fake()->paragraph(),
        ];
    }
}
