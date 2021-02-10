<?php

namespace App\Actions\Role;

use App\Contracts\RoleRepositoryInterface;

class UpdateRole
{

    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function execute(int $id, array $attributes): bool
    {
        $role = $this->roleRepository->update($id, $attributes);

        if(!$role) abort(404);

        return $role;
    }
}
