<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }//debe de quedarse en true para evitar rechazar todas las peticiones por defecto//


    public function rules(): array
    {
        $imageRules = 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048';
        if ($this->isMethod('post')) {
            $imageRules = 'required|image|mimes:jpeg,png,jpg,svg|max:2048';
        }

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('wines', 'name')->ignore($this->route('wine'))],
            //validamos que el nombre de la categoría no se repita en caso de edición(en caso de creacion sigue validando con el unique() definido en la migracion)//
            'description' => ['required','string','max:2000'],
            'category_id' => ['required', 'exists:categories,id'], //que exista en la columna id de la tabla categories//
            'year' => ['required', 'integer', 'min:' . now()->subYears(100)->year, 'max:' . now()->year],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => $imageRules,
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El nombre del vino es requerido',
            'name.string' => 'El nombre del vino debe ser un texto',
            'name.max' => 'El nombre del vino no puede superar los 255 caracteres',
            'name.unique' => 'El nombre del vino ya existe',

            'description.required' => 'La descripción del vino es requerida',
            'description.string' => 'La descripción del vino debe ser un texto',
            'description.max' => 'La descripción del vino no puede superar los 2000 caracteres',

            'category_id.required' => 'La categoría del vino es requerida',
            'category_id.exists' => 'La categoría seleccionada no existe',

            'year.required' => 'El año del vino es requerido',
            'year.integer' => 'El año del vino debe ser un número entero',
            'year.min' => 'El año del vino debe ser superior a :min',
            'year.max' => 'El año del vino debe ser inferior a :max',

            'price.required' => 'El precio del vino es requerido',
            'price.numeric' => 'El precio del vino debe ser un número',
            'price.min' => 'El precio del vino debe ser superior a :min',

            'stock.required' => 'El stock del vino es requerido',
            'stock.integer' => 'El stock del vino debe ser un número entero',
            'stock.min' => 'El stock del vino debe ser superior a :min',

            'image.required' => 'La imagen del vino es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'El archivo debe ser de tipo: jpeg, png, jpg o svg',
            'image.max' => 'El archivo no puede superar los 2MB',
        ];
    }

}
