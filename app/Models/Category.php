<?php

namespace App\Models;

use App\Services\UploadService;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
    ];

    public function wines()
    {
        return $this->hasMany(Wine::class);
    }

    public function imageUrl(): Attribute //nos ayuda a renderizar la imagen en la vista//
    {
        return Attribute::make(
            get: fn () => UploadService::url($this->image),
        );
    }



}
