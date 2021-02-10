<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

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
            ->where('users.id', '!=', auth()->id())
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
    public function findOne(int $id, $columns = array('*')): ?Model
    {
        return $this->model->role()->find($id, $columns);
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

        if (!empty($attributes['roles'])) {
            $item->roles()->sync($attributes['roles']);
        }

        return true;
    }
}
