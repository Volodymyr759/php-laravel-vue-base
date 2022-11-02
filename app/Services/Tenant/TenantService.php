<?php

namespace App\Services\Tenant;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tenant\Tenant;
use App\Services\Tenant\TenantServiceInterface;
use App\Services\Lease\LeaseServiceInterface;

class TenantService implements TenantServiceInterface
{
    protected $model;

    protected $leaseService;

    public function __construct(Tenant $model, LeaseServiceInterface $leaseService)
    {
        $this->model = $model;
        $this->leaseService = $leaseService;
    }

    public function list(array $params)
    {
        try {
            $query = $this->model->with('leases');

            // filtering
            if (!empty($params['search'])) {
                $query = $query->where('first_name', 'like', '%' . $params['search'] . '%')
                    ->orWhere('last_name', 'like', '%' . $params['search'] . '%');
            }

            // sorting
            if (empty($params['sort_field'])) {
                $query = $query->orderByDesc('id');
            } else {
                if ($params['sort_field'] == 'name') {
                    $params['sort'] == 'asc' ?
                        $query = $query->orderBy('first_name')->orderBy('last_name') :
                        $query = $query->orderByDesc('first_name')->orderByDesc('last_name');
                } else {
                    foreach ($this->model::SORTABLE as $field) {
                        if ($params['sort_field'] == $field) {
                            $params['sort'] == 'asc' ? $query = $query->orderBy($field) : $query = $query->orderByDesc($field);
                            break;
                        };
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
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Bad request",
                "message" => "Required params are missed. " . $e->getMessage()
            ])->setStatusCode(400, "Bad request");
        }
    }

    public function getById(int $id)
    {
        return $this->model->with('leases')->findOrFail($id);
    }

    public function search (string $name) 
    {
        return $this->model->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as fullName"))
                            ->where('first_name', 'like', '%' . $name . '%')
                            ->orWhere('last_name', 'like', '%' . $name . '%')
                            ->orderBy('first_name')->orderBy('last_name')
                            ->take(10)->get();
    }

    public function create(array $attributes)
    {
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();
        $createdTenant = $this->model->create($attributes);

        return $this->getById($createdTenant->id);
    }

    public function update(array $attributes)
    {
        $tenant = $this->model->findOrFail($attributes['id']);
        Validator::make($attributes, $this->model::VALIDATION_RULES)->validate();
        $tenant->update($attributes);
        $tenant->save();

        return $this->getById($tenant->id);
    }

    public function delete(int $id)
    {
        $tenant = $this->model->with('leases')->find($id);
        if (!$tenant) {
            return response()->json([
                "status" => 'Not Found',
                "message" => "Tenant not found"
            ])->setStatusCode(404, 'Tenant not found');
        }

        $leases = $tenant->leases;
        foreach ($leases as $lease) $this->leaseService->delete($lease->id);
        $tenant->delete();

        return $tenant;
    }
}
