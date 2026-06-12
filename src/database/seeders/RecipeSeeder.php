<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipes = [
            [
                'name' => 'Recipe 1',
                'created_by' => 1,
                'updated_by' => 1,
                'materials' => [
                    1 => 10,
                    2 => 20,
                    3 => 30,
                    4 => 40,
                    5 => 50,
                    6 => 60,
                ],
            ],
            [
                'name' => 'Recipe 2',
                'created_by' => 1,
                'updated_by' => 1,
                'materials' => [
                    1 => 40,
                    2 => 60,
                    3 => 70,
                    4 => 20,
                    6 => 60,
                ],
            ],
            [
                'name' => 'Recipe 3',
                'created_by' => 1,
                'updated_by' => 1,
                'materials' => [
                    1 => 10,
                    2 => 20,
                    5 => 50,
                    6 => 60,
                ],
            ],
        ];

        foreach ($recipes as $recipeData) {
            $materials = $recipeData['materials'];
            unset($recipeData['materials']);

            $recipe = \App\Models\Recipe::create($recipeData);

            $attach = [];
            foreach ($materials as $materialId => $qty) {
                $attach[$materialId] = ['quantity' => $qty];
            }

            $recipe->materials()->attach($attach);
        }
    }
}
