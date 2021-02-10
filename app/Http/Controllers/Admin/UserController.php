<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Role\GetAllRole;
use App\Actions\User\CreateUser;
use App\Actions\User\DeleteUser;
use App\Actions\User\FindOneUser;
use App\Actions\User\ListPaginatedUser;
use App\Actions\User\UpdateUser;
use Exception;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPaginatedUser $action)
    {
        $users = $action->execute();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetAllRole $action)
    {
        $roles = $action->execute();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateUser $action)
    {
        $this->validate($request, $this->rules($request));

        $inputs = $request->except('password');
        $inputs['password'] = bcrypt($request->password);

        $action->execute($inputs);

        return redirect()->route('users.index')
            ->with('success', 'Registro adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FindOneUser $action)
    {
        $user = $action->execute($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FindOneUser $action, GetAllRole $roleAction)
    {
        $user = $action->execute($id);

        $roles = $roleAction->execute();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateUser $action)
    {
        $this->validate($request, $this->rules($request, $id));

        $inputs = $request->all();

        $action->execute($id, $inputs);

        return redirect()->route('users.index')
            ->with('success', 'Registro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteUser $action)
    {
        try {
            $action->execute($id);
            return redirect()->route('users.index')
                ->with('success', 'Registro atualizado com sucesso.');
        } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Não foi possível deletar esse registro.');
        }
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'name' => ['required', 'max:120'],
            'phone' => ['required', 'max:11'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($primaryKey)],
            'is_enabled' => ['required'],
            'roles' => ['required']
        ];

        if (empty($primaryKey)) {
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        }

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
