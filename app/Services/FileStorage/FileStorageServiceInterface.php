<?php

namespace App\Services\FileStorage;

use Illuminate\Http\Request;

interface FileStorageServiceInterface {

    public function saveFile(array $attributes, int $parent_id);

    public function saveFiles(Request $request, int $parent_id);

    public function delete(int $id);

}