<?php

namespace App\Services\FileStorage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Document\Document;
use App\Services\FileStorage\FileStorageServiceInterface;

class DocumentService implements FileStorageServiceInterface
{
    protected $model;

    public function __construct(Document $model)
    {
        $this->model = $model;
    }

    public function getByLeaseId(int $id)
    {
        return $this->model->where(['lease_id' => $id])->get();
    }

    public function saveFile(array $attributes, int $parent_id)
    {
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();

        $file = $attributes['file'];
        $path = $file->store('public/docs');
        $name = basename($path);

        $document = new Document();
        $document->name = $name;
        $document->original_name = $file->getClientOriginalName();
        $document->full_path = env('DOCUMENT_STORE_BASE_URL') . $name;//should be like - http://127.0.0.1:8000/storage/docs/J5z5toTrpgg2BdlawaqCFXQazVpTLHK460yvvt1w.jpg read more: https://stackoverflow.com/questions/30191330/laravel-5-how-to-access-image-uploaded-in-storage-within-view
        $document->lease_id = $parent_id;
        $document->save();

        return $document;
    }
    
    public function saveFiles(Request $request, int $parent_id)
    {
        return 'Not implemented yet.';
    }

    public function delete(int $id)
    {
        $document = $this->model->find($id);

        if(!$document)
        {
            return response()->json([
                "status" => 'Not Found',
                "message" => "Document not found"
            ])->setStatusCode(404, 'Document not found');
        }

        if(Storage::exists('public/docs/' . $document->name)) Storage::delete('public/docs/' . $document->name);
        $document->delete();

        return $document;
    }
}