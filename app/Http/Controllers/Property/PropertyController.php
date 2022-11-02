<?php

namespace App\Http\Controllers\Property;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Property\Property;
use App\Services\Property\PropertyServiceInterface;

class PropertyController extends Controller
{
    protected $propertyService;

    public function __construct(PropertyServiceInterface $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function index (Request $request)
    {
        return $this->propertyService->list($request->all());
    }

    public function getById (int $id) 
    {
        return $this->propertyService->getById($id);
    }

    public function search (string $address) 
    {
        return $this->propertyService->search($address);
    }
    
    public function create (Request $request) 
    {
        return $this->propertyService->create($request -> all());
    }

    public function update (Request $request) 
    {
        return $this->propertyService->update($request -> all());
    }

    public function delete (int $id) 
    {
        return $this->propertyService->delete($id);
    }
}
