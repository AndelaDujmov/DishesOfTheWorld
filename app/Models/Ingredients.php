<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;

class Ingredients extends Model
{
    protected $fillable = [
        'title',
        'slug'
    ];

   
   
}
