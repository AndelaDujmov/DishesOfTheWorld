<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
    protected $table = 'meal_translations'; 

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}

