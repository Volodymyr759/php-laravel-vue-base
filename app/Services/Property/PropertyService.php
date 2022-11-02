<?php

namespace App\Services\Property;

use Illuminate\Support\Facades\Validator;
use App\Models\Property\Property;
use App\Services\Property\PropertyServiceInterface;
use App\Services\Lease\LeaseServiceInterface;
use App\Services\FileStorage\FileStorageServiceInterface;

class PropertyService implements PropertyServiceInterface
{
    protected $model;

    protected $leaseService;
    
    protected $imageService;

    public function __construct(
        Property $model, 
        LeaseServiceInterface $leaseService, 
        FileStorageServiceInterface $imageService)
    {
        $this->model = $model;
        $this->leaseService = $leaseService;
        $this->imageService = $imageService;
    }

    public function list(array $params)
    {
        $query = $this->model->with(['leases', 'images']);

        // filtering
        !empty($params['search']) && $query = $query->where('address', 'like', '%'.$params['search'].'%');
        !empty($params['status_filter']) && $query = $query->where('status', '=', $params['status_filter']);
        
        // sorting
        if(!empty($params['sort_field'])){
            foreach($this->model::SORTABLE as $field) {
                if($params['sort_field'] == $field){
                    $params['sort'] == 'asc' ? $query = $query->orderBy($field) : $query = $query->orderByDesc($field);
                    break;
                };
            }
        }
        
        $total = $query->count();

        // paginating
        $query = $query->skip(($params['page'] - 1) * $params['limit'])->take($params['limit'])->get();

        return response()->json([
            "data" => $query, 
            "total" => $total
            ])->setStatusCode(200, 'Ok');
    }

    public function getById(int $id)
    {
        return $this->model->with(['leases', 'images'])->findOrFail($id);
    }

    public function search (string $address) 
    {
        return $this->model->select('id', 'address')->where('address', 'like', '%'.$address.'%')->orderBy('address')->take(10)->get();
    }

    public function create(array $attributes)
    {
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();
        $createdProperty = $this->model->create($attributes);

        return $this->getById($createdProperty->id);
    }

    public function update(array $attributes)
    {
        $property = $this->model->findOrFail($attributes['id']);
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();
        $property->update($attributes);
        $property->save();

        return $this->getById($property->id);
    }
    
    public function delete(int $id)
    {
        $property = $this->model->with(['leases', 'images'])->find($id);
        if(!$property)
        {
            return response()->json([
                "status" => 'Not Found',
                "message" => "Property not found"
            ])->setStatusCode(404, 'Property not found');
        }

        $leases = $property->leases;
        foreach($leases as $lease) $this->leaseService->delete($lease->id);
        $images = $property->images;
        foreach($images as $image) $this->imageService->delete($image->id);

        $property->delete();

        return $property;
    }
}