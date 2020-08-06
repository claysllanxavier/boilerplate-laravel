<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface Permission
 * @package App\Repositories
 */
interface PermissionRepositoryInterface
{
    /**
     *  Get paginate resource
     *  Default 25 items for page
     * @param int $count
     * @return Collection
     */
    public function paginate(int $count = 25): LengthAwarePaginator;

    /**
     * Get resource
     * @param $id
     * @return Model
     */
    public function find(int $id): ?Model;

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
    public function update(int $id, array $attributes): ?Model;

    /**
     * Delete resource
     * @param $id
     * @return bool
     */
    public function delete(int $id): bool;
}
