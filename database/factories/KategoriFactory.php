<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kategori>
 */
class KategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_kategori' =>  '022',
            'user_id' => '1',
            'nama_kategori' => 'baju',
            'slug_kategori' => 'baju',
            'deskripsi_kategori' => 'lorem ipsum dolot siti amet',
            'status' => 'publish',
        ];
    }
}
