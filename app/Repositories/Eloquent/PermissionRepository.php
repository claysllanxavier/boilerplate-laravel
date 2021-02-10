<?php

namespace App\Repositories\Eloquent;

use App\Models\Permission;
use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
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
     *  Get all resources
     * @return Collection
     */
    public function getAll($columns = array('*')): Collection
    {
        return $this->model->all($columns);
    }
}
