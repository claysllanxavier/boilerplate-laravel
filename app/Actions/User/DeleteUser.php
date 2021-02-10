<?php

namespace App\Actions\User;

use App\Contracts\UserRepositoryInterface;

class DeleteUser
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): bool
    {
        $user = $this->userRepository->delete($id);

        if (!$user) abort(404);

        return $user;
    }
}
