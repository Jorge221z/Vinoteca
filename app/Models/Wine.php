<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\WithCurrencyFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Services\UploadService;

class Wine extends Model
{
    use HasSlug;
    use WithCurrencyFormatter;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'year',
        'price',
        'stock',
        'image',
    ];

    protected function casts()
    {
        return [
            'year' => 'integer',
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function category() //un vino pertecene a una categoria//
    {
        return $this->belongsTo(Category::class);
    }

    public function imageUrl(): Attribute //nos ayuda a renderizar la imagen en la vista//
    {
        return Attribute::make(
            get: fn () => UploadService::url($this->image),
        );
    }

    public function formattedPrice(): Attribute //formato el precio del vino para que sea legible//
     {
        return Attribute::make(
            get: fn () => $this->formatCurrency($this->price),
        );
     }

}
