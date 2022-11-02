<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\FileStorage\FileStorageServiceInterface', 'App\Services\FileStorage\ImageService');
        $this->app->bind('App\Services\Lease\LeaseServiceInterface', 'App\Services\Lease\LeaseService');
        $this->app->bind('App\Services\Notification\NotificationServiceInterface', 'App\Services\Notification\NotificationService');
        $this->app->bind('App\Services\Property\PropertyServiceInterface', 'App\Services\Property\PropertyService');
        $this->app->bind('App\Services\Tenant\TenantServiceInterface', 'App\Services\Tenant\TenantService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
