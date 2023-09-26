<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PelangganSeeder::class);
        $this->call(PemasokSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(PembelianSeeder::class);
        $this->call(DetailPembelianSeeder::class);
        $this->call(PenjualanSeeder::class);
        $this->call(DetailPenjualanSeeder::class);
    }
}
