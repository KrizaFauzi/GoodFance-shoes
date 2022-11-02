<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_produk' =>  Str::random(10),
            'user_id' => '2',
            'kategori_id' => '1',
            'nama_produk' => $this->faker->word,
            'slug_produk' => $this->faker->word,
            'deskripsi_produk' => $this->faker->paragraph(2),
            'status' => 'publish',
            'harga' => '20000',
            'satuan' => 'pcs',
            'qty' => '10'
        ];
    }
}
