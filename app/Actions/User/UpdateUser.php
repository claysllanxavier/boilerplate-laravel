<?php

namespace App\Actions\User;

use App\Contracts\UserRepositoryInterface;

class UpdateUser
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id, array $attributes): bool
    {
        $user = $this->userRepository->update($id, $attributes);

        if(!$user) abort(404);

        return $user;
    }
}
