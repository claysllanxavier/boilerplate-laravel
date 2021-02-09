<?php

namespace App\Actions\Permission;

use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreatePermission
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(array $attributes): Model
    {
        return $this->permissionRepository->create($attributes);
    }
}
