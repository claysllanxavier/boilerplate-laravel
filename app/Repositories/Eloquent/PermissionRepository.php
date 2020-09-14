<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }
}
