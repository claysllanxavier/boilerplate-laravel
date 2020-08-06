<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
    }

    public function create(array $attributes): Model
    {
        $attributes['guard_name'] = 'web';
        return $this->permission->create($attributes);
    }
}
