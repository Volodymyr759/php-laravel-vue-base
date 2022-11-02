<?php

namespace App\Services\FileStorage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Image\Image;
use App\Services\FileStorage\FileStorageServiceInterface;
use App\Services\Property\PropertyServiceInterface;

class ImageService implements FileStorageServiceInterface
{
    protected $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function saveFile(array $attributes, int $parent_id)
    {
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();

        $file = $attributes['file'];
        $path = $file->store('public/images');// file will be saved at public\storage\images
        $name = basename($path);

        $image = new Image();
        $image->name = $name;
        $image->full_path = env('IMAGE_STORE_BASE_URL') . $name;//should be like - http://127.0.0.1:8000/storage/images/J5z5toTrpgg2BdlawaqCFXQazVpTLHK460yvvt1w.jpg read more: https://stackoverflow.com/questions/30191330/laravel-5-how-to-access-image-uploaded-in-storage-within-view
        $image->property_id = $parent_id;
        $image->save();

        return $image;
    }

    public function saveFiles(Request $request, int $parent_id)
    {
        if(!$request->hasFile('file')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowedfileExtension = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
        $images = $request->all()['file'];

        foreach ($images as $file) {
            $extension = $file->getClientOriginalExtension();
            if(in_array($extension, $allowedfileExtension)) {
                $path = $file->store('public/images');
                $name = basename($path);
    
                $image = new Image();
                $image->name = $name;
                $image->full_path = env('IMAGE_STORE_BASE_URL') . $name;
                $image->property_id = $parent_id;
                $image->save();
            }
        }

        return response()->json(['files_uploaded'], 201);
    }

    public function delete(int $id)
    {
        $image = $this->model->find($id);

        if(!$image)
        {
            return response()->json([
                "status" => 'Not Found',
                "message" => "Image not found"
            ])->setStatusCode(404, 'Image not found');
        }

        if(Storage::exists('public/images/' . $image->name)) Storage::delete('public/images/' . $image->name);
        $image->delete();
        
        return $image;
    }
}