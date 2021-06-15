<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface User
 * @package App\Contracts
 */
interface UserRepositoryInterface
{
    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return LengthAwarePaginator
     */
    public function getPaginated(int $perPage = 25, $columns = array('*')): LengthAwarePaginator;

    /**
     * Get resource
     * @param $id
     * @return Model
     */
    public function findOne($id, $columns = array('*')): ?Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Update resource
     * @param array $attributes
     * @param $id
     * @return Model
     */
    public function update($id, array $attributes): ?bool;

    /**
     * Delete resource
     * @param $id
     * @return bool
     */
    public function delete($id): ?bool;
}
