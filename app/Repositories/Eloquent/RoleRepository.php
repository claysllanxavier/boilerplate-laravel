<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Contracts\RoleRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return Collection
     */
    public function getPaginated(int $perPage = 25, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model->orderBy('description')->paginate($perPage, $columns);
    }


    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $role = $this->model->create($attributes);

        if (!empty($attributes['permissions'])) {
            $role->permissions()->attach($attributes['permissions']);
        }

        return $role;
    }

    /**
     * Update resource
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(int $id, array $attributes): ?bool
    {
        $item = $this->model->find($id);
        if (!$item) null;

        $item->fill($attributes)->save();

        if (!empty($attributes['permissions'])) {
            $item->permissions()->sync($attributes['permissions']);
        }

        return true;
    }
}