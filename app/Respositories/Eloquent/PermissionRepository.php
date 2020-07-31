<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends BaseRepository
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
        $this->permission = $permission;
    }

    public function save(array $attributes): object
    {
        $attributes['guard_name'] = 'web';
        return $this->permission->create($attributes);
    }
}
