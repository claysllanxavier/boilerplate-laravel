<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('change-password.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, $this->rules($request));

        $this->userRepository->update(
            auth()->id(),
            ['password' => bcrypt($request->password)]
        );

        return redirect()->route('change-password.edit')
            ->with('success', 'Senha atualizada com sucesso.');
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'password' => ['required', 'min:6', 'confirmed'],
            'current_password' => ['required', new MatchOldPassword]
        ];

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
