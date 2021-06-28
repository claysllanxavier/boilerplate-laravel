<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends BaseController
{
    public function store(Request $request)
    {
        $validator = $this->getValidationFactory()
            ->make(
                $request->all(),
                $this->rules($request)
            );


        if ($validator->fails()) {
            return $this->sendError('Erro de validação', $validator->errors()->toArray(), 422);
        }

        $inputs = $request->all();


        if (Auth::attempt(array('email' => $inputs['email'], 'password' => $inputs['password']))) {
            $id = Auth::id();

            $user = User::find($id);

            $token = $user->createToken(config('app.key'));

            return $this->sendResponse([
                'user' => $user,
                'token' => $token->accessToken
            ], "Login successfully.");
        } else {
            return $this->sendError('Email ou senha inválidos', [], 401);
        }
    }

    public function destroy(Request $request)
    {
        $request->user()->token()->revoke();

        $this->sendResponse([], 'Logout realizado com sucesso.');
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
