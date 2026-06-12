<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;

class ProductionLogsExport implements FromArray
{
    private Collection $logs;
    private Collection $allMaterials;

    public function __construct(Collection $logs, Collection $allMaterials)
    {
        $this->logs = $logs;
        $this->allMaterials = $allMaterials;
    }

    public function array(): array
    {
        $rows = [];

        $header = ['日時', 'レシピ', '備考'];
        foreach ($this->allMaterials as $material) {
            $header[] = $material->name;
        }
        $rows[] = $header;

        foreach ($this->logs as $log) {
            $row = [
                (string) $log->weighed_at,
                optional($log->recipe)->name,
                $log->notes,
            ];

            foreach ($this->allMaterials as $material) {
                $matchedMaterial = $log->materials->firstWhere('id', $material->id);
                $quantity = $matchedMaterial ? (float) $matchedMaterial->pivot->actual_quantity : 0;
                $row[] = round($quantity, 3);
            }

            $rows[] = $row;
        }

        $totalRow = ['合計', '', ''];
        foreach ($this->allMaterials as $material) {
            $total = $this->logs->sum(function ($log) use ($material) {
                $matchedMaterial = $log->materials->firstWhere('id', $material->id);
                return $matchedMaterial ? (float) $matchedMaterial->pivot->actual_quantity : 0;
            });
            $totalRow[] = round($total, 3);
        }
        $rows[] = $totalRow;

        return $rows;
    }
}
