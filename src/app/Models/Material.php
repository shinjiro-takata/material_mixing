<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
    ];

    protected $appends = ['formatted_quantity'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_materials')->withPivot('quantity', 'tolerance');
    }

    public function getFormattedQuantityAttribute()
    {
        return number_format($this->pivot->quantity, 3);
    }
}
