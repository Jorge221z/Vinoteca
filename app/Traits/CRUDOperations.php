<?php

namespace App\Traits;

use App\Services\UploadService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

trait CRUDOperations
{

    public function model(?string $slug = null): Model
    {
        if ($slug) {
           return $this->model::whereSlug($slug)->firstOrFail();
        }

        return app($this->model);
    }

    public function paginate(array $counts = [], array $relationships = [], int $perPage = 10):LengthAwarePaginator
    {
        return $this->model()::query()
        ->with($relationships)
        ->withCount($counts)
        ->paginate($perPage);
    }

    public function create(array $data): Model
    {
        $image = UploadService::upload(data_get($data, 'image'), strtolower(class_basename($this->model)));
        return $this->model()::create(array_merge($data, ['image' => $image]));
    }

    public function update(array $data, Model $model):Model
    {
        if (data_get($data, 'image'))
        {
            UploadService::delete($model->image);
            data_set(
                $data,
                'image',
                UploadService::upload(data_get($data, 'image'), strtolower(class_basename($this->model)))
            );
        }
        $model->update($data);
        return $model;
    }


    public function delete(Model $model): ?bool
    {
        // Check if the model has a 'deleteChecks' method
        if (method_exists($this, 'deleteChecks')) {
            // If it exists, call the 'deleteChecks' method
            $this->deleteChecks($model);
        }

       // Si las comprobaciones pasan, procedemos con la eliminación
    $deleted = $model->delete();

    // Si la eliminación fue exitosa, entonces borramos la imagen
    if ($deleted) { //esto es para evitar errores relacionados con la imagen//
        UploadService::delete($model->image);
    }

    return $deleted;
    }

}
