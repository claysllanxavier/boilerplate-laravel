<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                $this->rules($request)
            );

        if ($validator->fails()) {
            return $this->sendError('Erro de Validação.', $validator->errors()->toArray(), 422);
        }

        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->input('password'));
        $inputs['roles'] = [2];

        $this->userRepository->create($inputs);

        $this->sendResponse([], 'Conta criada com sucesso.', 201);
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'name' => ['required', 'max:120'],
            'email' => ['required', 'email', 'max:189', Rule::unique('users')->ignore($primaryKey)],
            'phone' => ['required', 'max:15'],
            'password' => ['required', 'min:8']
        ];

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
