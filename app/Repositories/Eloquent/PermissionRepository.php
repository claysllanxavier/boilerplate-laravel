<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Contracts\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }
}
