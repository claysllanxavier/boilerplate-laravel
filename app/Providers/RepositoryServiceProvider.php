<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\EloquentRepositoryInterface;
use App\Contracts\PermissionRepositoryInterface;
use App\Contracts\RoleRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RoleRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        EloquentRepositoryInterface::class => BaseRepository::class,
        PermissionRepositoryInterface::class => PermissionRepository::class,
        RoleRepositoryInterface::class => RoleRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
