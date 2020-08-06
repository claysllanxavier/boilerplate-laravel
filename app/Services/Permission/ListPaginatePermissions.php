<?php

namespace App\Services\Permission;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPaginatePermissions
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(): LengthAwarePaginator
    {
        return $this->permissionRepository->paginate();
    }
}
