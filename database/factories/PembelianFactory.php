<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pemasok;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembelian>
 */
class PembelianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_masuk' => 'P'.sprintf('%08d',fake()->unique()->numberBetween(1,99999999)),
            'tanggal_masuk' => date('Y-m-d'),
            'total' => fake()->numberBetween(1000,1000000),
            'pemasok_id' => fake()->randomElement(Pemasok::select('id')->get()),
            'user_id' => '1'
        ];
    }
}
