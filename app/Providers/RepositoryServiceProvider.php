<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\EloquentRepositoryInterface;
use App\Contracts\PermissionRepositoryInterface;
use App\Contracts\RoleRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Contracts\PostCategoryRepositoryInterface;
use App\Repositories\Eloquent\PostCategoryRepository;

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
        UserRepositoryInterface::class => UserRepository::class,
        PostCategoryRepositoryInterface::class => PostCategoryRepository::class,
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
