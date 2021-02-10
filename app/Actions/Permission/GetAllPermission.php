<?php

namespace App\Actions\Permission;

use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllPermission
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(): Collection
    {
        return $this->permissionRepository->getAll(['id', 'description']);
    }
}
