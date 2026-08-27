<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Material;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('materials')->get();
        return view('recipes.index', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('materials');
        return view('recipes.show', compact('recipe'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('recipes.create', compact('materials'));
    }

    public function store(StoreRecipeRequest $request)
    {
        $recipe = Recipe::create($request->validated());

        $materials = [];
        foreach ($request->material_ids as $material_id) {
            if (isset($request->materials[$material_id])) {
                $materials[$material_id] = [
                    'quantity' => $request->materials[$material_id],
                    'tolerance' => $request->tolerances[$material_id] ?? null
                ];
            }
        }
        $recipe->materials()->attach($materials);
        return redirect()->route('recipes.index');
    }

    public function edit(Recipe $recipe)
    {
        $materials = Material::all();
        // このレシピに紐付く材料ID一覧（checkbox の checked 判定用）
        $recipeMaterialIds = $recipe->materials->pluck('id')->toArray();
        // このレシピの各材料ごとの数量（input value 埋め込み用）
        $recipeMaterials = $recipe->materials->pluck('pivot.quantity', 'id')->toArray();
        // このレシピの各材料ごとの許容範囲（input value 埋め込み用）
        $recipeTolerance = $recipe->materials->pluck('pivot.tolerance', 'id')->toArray();

        return view('recipes.edit', compact('recipe', 'materials', 'recipeMaterialIds', 'recipeMaterials', 'recipeTolerance'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->update($request->validated());

        // 新しい材料を追加
        if ($request->new_material_name && $request->new_material_unit) {
            $newMaterial = Material::firstOrCreate(
                ['name' => $request->new_material_name, 'unit' => $request->new_material_unit],
                ['name' => $request->new_material_name, 'unit' => $request->new_material_unit]
            );
            // $request->new_material_ids[]に新しい材料のIDを追加
            $material_ids = $request->material_ids ?? [];
            $material_ids[] = $newMaterial->id;
            $request->merge(['material_ids' => $material_ids]);

            // 新材料の数量を設定
            $materials = $request->materials ?? [];
            if ($request->new_material_quantity !== null) {
                $materials[$newMaterial->id] = $request->new_material_quantity;
            } else {
                $materials[$newMaterial->id] = 0;
            }
            $request->merge(['materials' => $materials]);
        }

        $syncArray = [];
        foreach ($request->material_ids as $material_id) {
            if (isset($request->materials[$material_id])) {
                $syncArray[$material_id] = [
                    'quantity' => $request->materials[$material_id],
                    'tolerance' => $request->tolerances[$material_id] ?? null
                ];
            }
        }
        $recipe->materials()->sync($syncArray);

        return redirect()->route('recipes.index');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index');
    }
}
