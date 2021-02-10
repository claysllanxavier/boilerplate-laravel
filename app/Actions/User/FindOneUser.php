<?php

namespace App\Actions\User;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FindOneUser
{

    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id, array $columns = array('*')): Model
    {
        $user = $this->userRepository->findOne($id, $columns);

        if (!$user) abort(404);

        if($user->id == auth()->id()) abort(403, 'Você não pode visualizar esse usuário.');

        return $user;
    }
}
