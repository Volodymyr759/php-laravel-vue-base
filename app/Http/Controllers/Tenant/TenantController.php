<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Tenant\TenantServiceInterface;

class TenantController extends Controller
{
    protected $tenantService;

    public function __construct(TenantServiceInterface $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index (Request $request)
    {
        return $this->tenantService->list($request->all());
    }

    public function getById (int $id) 
    {
        return $this->tenantService->getById($id);
    }

    public function search (string $name) 
    {
        return $this->tenantService->search($name);
    }

    public function create (Request $request) 
    {
        return $this->tenantService->create($request -> all());
    }

    public function update (Request $request) 
    {
        return $this->tenantService->update($request -> all());
    }

    public function delete (int $id) 
    {
        return $this->tenantService->delete($id);
    }
}
