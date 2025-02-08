<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize(): bool //ponemos true porque ya validamos la autorización en las rutas//
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $imageRules = 'sometimes|image|mimes:jpeg,png,jpg,svg|max:2048';
        if ($this->isMethod('post')) {
            $imageRules = 'required|image|mimes:jpeg,png,jpg,svg|max:2048';
        }
        //si estamos creando la imagen será requerida, pero si estamos editando no//

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($this->route('category'))],
            //validamos que el nombre de la categoría no se repita en caso de edición(en caso de creacion sigue validando con el unique() definido en la migracion)//
            'description' => 'required|string|max:2000',
            'image' => $imageRules,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'La categoria es requerida',
            'name.string' => 'La categoría debe ser un texto',
            'name.max' => 'La categoría no puede superar los 255 caracteres',
            'name.unique' => 'La categoría ya existe',

            'description.required' => 'La descripción es requerida',
            'description.string' => 'La descripción debe ser un texto',
            'description.max' => 'La descripción no puede superar los 2000 caracteres',

            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo debe ser una imagen',
            'image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o svg',
            'image.max' => 'La imagen no puede superar los 2MB',
        ];
    }
}
