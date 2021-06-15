<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        "App\Contracts\EloquentRepositoryInterface" => "App\Repositories\Eloquent\BaseRepository",
        "App\Contracts\PermissionRepositoryInterface" => "App\Repositories\Eloquent\PermissionRepository",
        "App\Contracts\RoleRepositoryInterface" => "App\Repositories\Eloquent\RoleRepository",
        "App\Contracts\UserRepositoryInterface" => "App\Repositories\Eloquent\UserRepository",
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
