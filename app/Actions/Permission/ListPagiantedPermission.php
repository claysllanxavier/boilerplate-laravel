<?php

namespace App\Actions\Permission;

use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPaginatedPermission
{

    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function execute(int $perPage = 25, $columns = array('*')): LengthAwarePaginator
    {
        return $this->permissionRepository->getPaginated($perPage, $columns);
    }
}
