<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Astrotomic\Translatable\Translatable;

class Tags extends Model implements TranslatableContracts
{
    use Translatable;

    protected $fillable = [
        'title',
        'slug'
    ];

    public $translatedAttributes = ['title'];

    public function languages()
    {
        return $this->belongsToMany(Languages::class, 'languages_tag');
    }
}
