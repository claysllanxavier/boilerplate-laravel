<?php

namespace App\Actions\Permission;

use App\Contracts\PermissionRepositoryInterface;

class DeletePermission
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(int $id): bool
    {
        $permission = $this->permissionRepository->delete($id);

        if(!$permission) abort(404);

        return $permission;
    }
}
