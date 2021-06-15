<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return Collection
     */
    public function getPaginated(int $perPage = 25, $columns = array('*')): LengthAwarePaginator
    {
        return $this->model->role()
            ->orderBy('users.name')
            ->paginate($perPage, $columns);
    }


    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $user = $this->model->create($attributes);

        if (!empty($attributes['roles'])) {
            $user->roles()->attach($attributes['roles']);
        }

        return $user;
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

        return $this->model->role()->findOrFail($id, $columns);
    }

    /**
     * Update resource
     * @param array $attributes
     * @param $id
     * @return Model
     */
    public function update($id, array $attributes): ?bool
    {
        if (!is_numeric($id)) {
            throw new ModelNotFoundException();
        }

        $item = $this->model->findOrFail($id);

        $item->fill($attributes)->save();

        if (!empty($attributes['roles'])) {
            $item->roles()->sync($attributes['roles']);
        }

        return true;
    }
}
