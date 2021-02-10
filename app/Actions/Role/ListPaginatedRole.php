<?php

namespace App\Actions\Role;

use App\Contracts\RoleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPaginatedRole
{

    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function execute(int $perPage = 25, $columns = array('*')): LengthAwarePaginator
    {
        return $this->roleRepository->getPaginated($perPage, $columns);
    }
}
