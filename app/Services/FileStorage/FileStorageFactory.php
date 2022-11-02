<?php

namespace App\Services\FileStorage;

use App\Services\FileStorage\DocumentService;
use App\Models\Document\Document;

class FileStorageFactory
{
	public static function getDocumentService() : DocumentService
	{
		return new DocumentService(new Document());
	}
}