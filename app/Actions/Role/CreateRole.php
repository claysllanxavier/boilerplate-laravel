<?php

namespace App\Actions\Role;

use App\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateRole
{

    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function execute(array $attributes): Model
    {
        return $this->roleRepository->create($attributes);
    }
}
