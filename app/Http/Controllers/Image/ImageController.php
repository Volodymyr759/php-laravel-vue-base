<?php

namespace App\Http\Controllers\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FileStorage\FileStorageServiceInterface;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(FileStorageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    public function upload(Request $request, int $id)
    {
        return $this->imageService->saveFile($request->all(), $id);
    }

    public function uploadMany(Request $request, int $id)
    {
        return $this->imageService->saveFiles($request, $id);
    }

    public function delete(int $id)
    {
        return $this->imageService->delete($id);
    }
}
