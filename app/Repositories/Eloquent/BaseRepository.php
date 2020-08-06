<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\EloquentRepositoryInterface;



class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     *  Get all resources
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return Collection
     */
    public function paginate(int $count = 25): LengthAwarePaginator
    {
        return $this->model->paginate($count);
    }

    /**
     * Get resource
     * @param $id
     * @return Model
     */
    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
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
    public function update(int $id, array $attributes): Model
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * Delete resource
     * @param $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }
}
