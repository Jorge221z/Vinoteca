<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Services\UploadService;
use NumberFormatter;

class Wine extends Model
{
    use HasSlug;

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
        $formatter = new NumberFormatter('es_ES', NumberFormatter::CURRENCY); //trabajamos con valores monetarios de españa//

        return Attribute::make(
            get: fn () => $formatter->formatCurrency($this->price, 'EUR'),
        );
     }

}
