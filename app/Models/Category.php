<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'title',
        'slug'
    ];

    public $translatedAttributes = ['title'];

    public function languages()
    {
        return $this->belongsToMany(Languages::class, 'languages_category');
    }
}
