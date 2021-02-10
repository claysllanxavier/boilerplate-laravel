<?php

namespace App\Actions\User;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateUser
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(array $attributes): Model
    {
        return $this->userRepository->create($attributes);
    }
}
