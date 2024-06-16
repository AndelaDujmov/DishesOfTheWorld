<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class MealTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'meal_translations'; 

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}

