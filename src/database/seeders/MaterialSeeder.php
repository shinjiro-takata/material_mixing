<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            ['name' => 'Material A', 'unit' => 'kg'],
            ['name' => 'Material B', 'unit' => 'kg'],
            ['name' => 'Material C', 'unit' => 'kg'],
            ['name' => 'Material D', 'unit' => 'kg'],
            ['name' => 'Material E', 'unit' => 'kg'],
            ['name' => 'Material F', 'unit' => 'kg'],
            ['name' => 'Material G', 'unit' => 'kg'],
            ['name' => 'Material H', 'unit' => 'kg'],

        ];

        foreach ($materials as $material) {
            \App\Models\Material::create($material);
        }
    }
}
