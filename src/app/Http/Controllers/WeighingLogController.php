<?php

namespace App\Http\Controllers;

use App\Exports\ProductionLogsExport;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\ProductionLog;
use App\Http\Requests\StoreWeighingLogRequest;
use App\Models\Material;
use Maatwebsite\Excel\Facades\Excel;

class WeighingLogController extends Controller
{
    public function create()
    {
        $selectedRecipeId = request('recipe_id');
        $recipes = Recipe::all();
        $recipe = null;

        if ($selectedRecipeId) {
            $recipe = Recipe::with('materials')->find($selectedRecipeId);
        }

        return view('logs.create', compact('recipes', 'recipe', 'selectedRecipeId'));
    }

    public function store(StoreWeighingLogRequest $request)
    {
        $log = ProductionLog::create([
            'user_id' => auth()->id(),
            'recipe_id' => $request->recipe_id,
            'weighed_at' => $request->weighed_at,
            'notes' => $request->notes,
        ]);

        $materials = [];
        foreach ($request->materials as $material_id => $quantity) {
            $materials[$material_id] = ['actual_quantity' => $quantity];
        }
        $log->materials()->attach($materials);

        return redirect()->route('logs.index');
    }

    public function index()
    {
        $logs = ProductionLog::query()
            ->with('recipe', 'user', 'materials')
            ->when(request('start_date'), function ($q) {
                $q->whereDate('weighed_at', '>=', request('start_date'));
            })
            ->when(request('end_date'), function ($q) {
                $q->whereDate('weighed_at', '<=', request('end_date'));
            })
            ->when(request('recipe_id'), function ($q) {
                $q->where('recipe_id', request('recipe_id'));
            })
            ->get();

        $recipes = Recipe::all();
        $allMaterials = Material::all();

        return view('logs.index', compact('logs', 'recipes', 'allMaterials'));
    }

    public function export(Request $request)
    {
        $logs = ProductionLog::query()
            ->with('recipe', 'user', 'materials')
            ->when($request->start_date, function ($q) use ($request) {
                $q->whereDate('weighed_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($q) use ($request) {
                $q->whereDate('weighed_at', '<=', $request->end_date);
            })
            ->when($request->recipe_id, function ($q) use ($request) {
                $q->where('recipe_id', $request->recipe_id);
            })
            ->get();

        $allMaterials = Material::all();
        $fileName = 'production_logs_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new ProductionLogsExport($logs, $allMaterials), $fileName);
    }
}
