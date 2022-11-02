<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FileStorage\FileStorageFactory;

class DocumentController extends Controller
{
    protected $documentService;

    /**
     * Read more about factory method: https://evryn.dev/factory-design-pattern-with-laravel-example/
     */
    public function __construct()
    {
        $this->documentService = FileStorageFactory::getDocumentService();
    }

    public function upload(Request $request, int $id)
    {
        return $this->documentService->saveFile($request->all(), $id);
    }

    public function delete(int $id)
    {
        return $this->documentService->delete($id);
    }
}
