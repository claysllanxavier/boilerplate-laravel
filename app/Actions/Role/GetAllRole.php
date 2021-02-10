<?php

namespace App\Actions\Role;

use App\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllRole
{

    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function execute(): Collection
    {
        return $this->roleRepository->getAll(['id', 'description']);
    }
}
