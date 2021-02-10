<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface Role
 * @package App\Contracts
 */
interface RoleRepositoryInterface
{
    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return Collection
     */
    public function getPaginated(int $perPage = 25, $columns = array('*')): LengthAwarePaginator;

    /**
     * Get resource
     * @param $id
     * @return Model
     */
    public function findOne(int $id, $columns = array('*')): ?Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Update resource
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update(int $id, array $attributes): ?bool;

    /**
     * Delete resource
     * @param $id
     * @return bool
     */
    public function delete(int $id): ?bool;
}
