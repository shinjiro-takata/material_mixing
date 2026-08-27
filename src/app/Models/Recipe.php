<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'recipe_materials')->withPivot('quantity', 'tolerance');
    }

    public function productionLogs()
    {
        return $this->hasMany(ProductionLog::class);
    }
}
