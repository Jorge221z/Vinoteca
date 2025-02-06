<?php

namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{

//la funcion uplodad recibe un archivo y una carpeta donde se va a guardar y el disco donde se va a guardar//
    public static function upload(UploadedFile $file, string $folder, $disk = 'public')
    {
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $extension = $file->getClientOriginalExtension();

        $filetime = $filename . '-' . time() . '-' . $extension;

        return $file->storeAs($folder, $filename, $disk);
    }

    public static function delete(string $path, $disk = 'public')
    {
        if (!Storage::disk($disk)->exists($path)) { //caso en el que no lo encuentre//
            return false;
        }

        return Storage::disk($disk)->delete($path);
    }

    public static function url(string $path, $disk = 'public') //funcion para acceder a los recursos que estamos subiendo//
    {
        return Storage::disk($disk)->url($path);
    }
}
