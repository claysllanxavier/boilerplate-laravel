<?php

namespace App\Actions\Permission;

use App\Contracts\PermissionRepositoryInterface;

class UpdatePermission
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(int $id, array $attributes): bool
    {
        $permission = $this->permissionRepository->update($id, $attributes);

        if(!$permission) abort(404);

        return $permission;
    }
}
