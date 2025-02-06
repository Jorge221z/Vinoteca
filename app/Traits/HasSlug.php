<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait HasSlug  //los traits sirven para ver URL's mas amigables, este codigo se encarga de procesarlas automaticamente//
{

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function bootHasSlug()
    {
        static::saving(function ($model)
        {
            $model->slug = Str::slug($model->name);
        });
    }




}
