<?php

namespace App\Services\Lease;

use Illuminate\Support\Facades\Validator;
use App\Services\FileStorage\FileStorageFactory;
use App\Models\Lease\Lease;

class LeaseService implements LeaseServiceInterface
{
    protected $model;

    protected $documentService;

    public function __construct(Lease $model)
    {
        $this->model = $model;
        $this->documentService = FileStorageFactory::getDocumentService();
    }

    public function list(array $params)
    {
        try {
            $query = $this->model->with(['property', 'tenant', 'documents']);

            // filtering
            if(!empty($params['search'])) {
                $search = $params['search'];
                $query->whereIn('property_id', function($query) use ($search)
                    {
                        $query->select('id')
                            ->from('properties')
                            ->where('address', 'like', '%' . $search . '%');
                    });
            }
            !empty($params['status_filter']) && $query = $query->where('status', '=', $params['status_filter']);

            // sorting
            if (empty($params['sort_field'])) {
                $query = $query->orderByDesc('id');
            } else {
                foreach ($this->model::SORTABLE as $field) {
                    if ($params['sort_field'] == $field) {
                        $params['sort'] == 'asc' ? $query = $query->orderBy($field) : $query = $query->orderByDesc($field);
                        break;
                    };
                };
            }

            $total = $query->count();

            // paginating
            $query = $query->skip(($params['page'] - 1) * $params['limit'])->take($params['limit'])->get();

            return response()->json([
                "data" => $query,
                "total" => $total
            ])->setStatusCode(200, 'Ok');
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Bad request",
                "message" => "Required params are missed. " . $e->getMessage()
            ])->setStatusCode(400, "Bad request");
        }
    }

    public function getById(int $id)
    {
        return $this->model->with(['property', 'tenant', 'documents'])->findOrFail($id);
    }

    public function create(array $attributes)
    {
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();
        $createdLease = $this->model->create($attributes);

        return $this->getById($createdLease->id);
    }

    public function update(array $attributes)
    {
        $lease = $this->model->findOrFail($attributes['id']);
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();
        $lease->update($attributes);
        $lease->save();
        
        return $this->getById($lease->id);
    }

    public function delete(int $id)
    {
        $lease = $this->model->find($id);
        if (!$lease) {
            return response()->json([
                "status" => 'Not Found',
                "message" => "Lease not found"
            ])->setStatusCode(404, 'Lease not found');
        }
        $documents = $lease->documents;
        foreach ($documents as $document) $this->documentService->delete($document->id);
        $lease->delete();

        return $lease;
    }
}
