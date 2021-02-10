<?php

namespace App\Actions\Role;

use App\Contracts\RoleRepositoryInterface;

class DeleteRole
{

    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function execute(int $id): bool
    {
        $role = $this->roleRepository->delete($id);

        if (!$role) abort(404);

        return $role;
    }
}
