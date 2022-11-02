<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Lease\LeaseController;
use App\Http\Controllers\Notification\NotificationCotroller;
use App\Http\Controllers\Property\PropertyController;
use App\Http\Controllers\Tenant\TenantController;

// Public routes - Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/leases', [LeaseController::class, 'index']);
    Route::get('/leases/{id}', [LeaseController::class, 'getById']);
    Route::post('/leases', [LeaseController::class, 'create']);
    Route::put('/leases', [LeaseController::class, 'update']);
    Route::delete('/leases/{id}', [LeaseController::class, 'delete']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/notifications', [NotificationCotroller::class, 'index']);
    Route::post('/notifications', [NotificationCotroller::class, 'create']);
    Route::delete('/notifications/{id}', [NotificationCotroller::class, 'delete']);

    Route::get('/properties', [PropertyController::class, 'index']);
    Route::get('/properties/{id}', [PropertyController::class, 'getById']);
    Route::get('/properties/search/{address}', [PropertyController::class, 'search']);
    Route::post('/properties', [PropertyController::class, 'create']);
    Route::put('/properties', [PropertyController::class, 'update']);
    Route::delete('/properties/{id}', [PropertyController::class, 'delete']);

    Route::post('/products', [ProductController::class, 'create']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);

    Route::get('/tenants', [TenantController::class, 'index']);
    Route::get('/tenants/{id}', [TenantController::class, 'getById']);
    Route::get('/tenants/search/{name}', [TenantController::class, 'search']);
    Route::post('/tenants', [TenantController::class, 'create']);
    Route::put('/tenants', [TenantController::class, 'update']);
    Route::delete('/tenants/{id}', [TenantController::class, 'delete']);

    Route::post('/images/upload/{id}', [ImageController::class, 'upload']);// id = identifier of parent entity (for example Property - property_id)
    Route::post('/images/uploads/{id}', [ImageController::class, 'uploadMany']);
    Route::delete('/images/delete/{id}', [ImageController::class, 'delete']);
    
    Route::post('/documents/upload/{id}', [DocumentController::class, 'upload']);// id = identifier of parent entity Lease - lease_id
    Route::delete('/documents/delete/{id}', [DocumentController::class, 'delete']);
});