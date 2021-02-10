<?php

namespace App\Actions\Permission;

use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FindOnePermission
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(int $id): Model
    {
        $permission = $this->permissionRepository->findOne($id);

        if(!$permission) abort(404);

        return $permission;
    }
}
