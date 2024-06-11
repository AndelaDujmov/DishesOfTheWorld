<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;

class Meal extends Model implements TranslatableContracts
{
    use Translatable;

    protected $table = 'meal';

    public $translatedAttributes = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'meal', 'id', 'category_id');
    }


    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'meal_tag', 'meal_id', 'tag_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredients::class, 'meal_ingredient', 'meal_id', 'ingredient_id');
    }

    public function languages()
    {
        return $this->belongsToMany(MealTranslation::class, 'meal_translations', 'meal_id', 'language_id');
    }
}
