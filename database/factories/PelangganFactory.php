<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_pelanggan' => 'PL'.sprintf('%08d',fake()->unique()->numberBetween(1,99999999)),
            'nama' => fake()->name($gender = 'male'|'female'),
            'alamat' => fake()->address(),
            'no_telp' => fake()->phoneNumber(),
            'email' => fake()->email(),
        ];
    }
}
