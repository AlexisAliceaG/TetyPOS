<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Scribe',
            'BIC',
            'Crayola',
            'Paper Mate',
            'Barrilito',
            'Mattel',
            'Hasbro',
            'Janel',
            'Azor',
            'Norma',
            'Genérica',
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'name' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}