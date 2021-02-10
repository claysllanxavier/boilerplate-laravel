<?php

namespace App\Actions\User;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ListPaginatedUser
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $perPage = 25, $columns = array('*')): LengthAwarePaginator
    {
        return $this->userRepository->getPaginated($perPage, $columns);
    }
}
