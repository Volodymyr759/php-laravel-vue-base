<?php

namespace App\Http\Controllers\Lease;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Lease\Lease;
use App\Services\Lease\LeaseServiceInterface;

class LeaseController extends Controller
{
    protected $leaseService;

    public function __construct(LeaseServiceInterface $leaseService)
    {
        $this->leaseService = $leaseService;
    }

    public function index (Request $request)
    {
        return $this->leaseService->list($request->all());
    }

    public function getById (int $id) 
    {
        return $this->leaseService->getById($id);
    }
    
    public function create (Request $request) 
    {
        return $this->leaseService->create($request -> all());
    }

    public function update (Request $request) 
    {
        return $this->leaseService->update($request -> all());
    }

    public function delete (int $id) 
    {
        return $this->leaseService->delete($id);
    }
}
