<?php

namespace App\Repositories\Eloquent;

use App\Models\PostCategory;
use App\Contracts\PostCategoryRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PostCategoryRepository extends BaseRepository implements PostCategoryRepositoryInterface
{
    protected $permission;

    public function __construct(PostCategory $permission)
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
        return $this->model->orderBy('name')->paginate($perPage, $columns);
    }

    /**
     *  Get all resources
     * @return Collection
     */
    public function getAll($columns = array('*')): Collection
    {
        return $this->model->orderBy('name')->get($columns);
    }
}
