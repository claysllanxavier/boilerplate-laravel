<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        $users = User::role()->where('users.id', '!=', auth()->id())
            ->orderBy('users.name')->paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'description')
            ->orderBy('description')->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules($request));

        $inputs = $request->except('password');
        $inputs['password'] = bcrypt($request->password);
        $user = User::create($inputs);

        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success', 'Registro adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::role()->findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::select('id', 'description')
            ->orderBy('description')->get();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, $this->rules($request, $id));

        $inputs = $request->except('roles');

        $user->fill($inputs)->save();

        $user->syncRoles($request->roles);


        return redirect()->route('users.index')
            ->with('success', 'Registro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
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
            'cpf' => ['required', 'max:11', new Cpf],
            'email' => ['required', 'email'],
            'is_enabled' => ['required'],
            'roles' => ['required']
        ];

        if (empty($primaryKey)) {
            array_push($rules['email'], Rule::unique('users'));
            array_push($rules['cpf'], Rule::unique('users'));
            $rules['password'] = ['required', 'min:8', 'confirmed'];
        } else {
            array_push($rules['email'], Rule::unique('users')->ignore($primaryKey));
            array_push($rules['cpf'], Rule::unique('users')->ignore($primaryKey));
        }

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
