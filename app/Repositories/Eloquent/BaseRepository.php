<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Contracts\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    protected function __construct(protected Model $model)
    {}

    /**
     *  Get all resources
     * @return Collection
     */
    public function getAll($columns = array('*')): Collection
    {
        return $this->model->all($columns);
    }

    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return Collection
     */
    public function getPaginated(int $perPage = 25, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Get resource
     * @param $id
     * @return Model
     */
    public function findOne($id, $columns = array('*')): ?Model
    {
        if (!is_numeric($id)) {
            throw new ModelNotFoundException();
        }

        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Update resource
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update($id, array $attributes): ?bool
    {
        if (!is_numeric($id)) {
            throw new ModelNotFoundException();
        }

        $item = $this->model->findOrFail($id);

        return $item->fill($attributes)->save();
    }

    /**
     * Delete resource
     * @param $id
     * @return bool
     */
    public function delete($id): ?bool
    {
        if (!is_numeric($id)) {
            throw new ModelNotFoundException();
        }

        $model = $this->model->findOrFail($id);

        return $model->delete();
    }
}
