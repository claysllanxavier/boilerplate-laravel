<?php

namespace App\Actions\Role;

use App\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FindOneRole
{

    protected $roleRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }

    public function execute(int $id, array $columns = array('*')): Model
    {
        $role = $this->roleRepository->findOne($id, $columns);

        if (!$role) abort(404);

        return $role;
    }
}
