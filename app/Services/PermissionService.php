<?php

namespace App\Services;

use App\Repositories\Eloquent\PermissionRepository;
use Illuminate\Support\Facades\Validator;


class PermissionService
{
    protected $permissionRepository;

    public function __construct(
        PermissionRepository $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    public function all(): object
    {
        return $this->permissionRepository->paginate();
    }

    public function save(array $data, array $rules, array $messages = []): object
    {
        Validator::make(
            $data,
            $rules,
            $messages
        )->validate();

        $permission = $this->permissionRepository->save($data);

        return $permission;
    }

    public function find($id): object
    {
        return $this->permissionRepository->find($id);
    }

    public function update(int $id, array $data, array $rules, array $messages = []): object
    {
        Validator::make(
            $data,
            $rules,
            $messages
        )->validate();

        $permission = $this->permissionRepository->find($id);

        $permission = $permission->fill($data)->save();

        return $permission;
    }

    public function delete($id): bool
    {
        $permission = $this->permissionRepository->find($id);
        return $permission->delete();
    }
}
