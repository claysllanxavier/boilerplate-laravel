<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('description')->paginate(25);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('description')->get();

        return view('roles.create', compact('permissions'));
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

        $inputs = $request->except('permissions');

        $role = Role::create($inputs);

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.index')
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
        $role = Role::findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        $permissions = Permission::orderBy('description')->get();

        return view('roles.edit', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);

        $this->validate($request, $this->rules($request, $id));

        $inputs = $request->except('permissions');

        $role->fill($inputs)->save();

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')
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
        $role = Role::findOrFail($id);
        try {
            $role->delete();
            return redirect()->route('roles.index')
                ->with('success', 'Registro atualizado com sucesso.');
        } catch (Exception $e) {
            return redirect()->route('roles.index')
                ->with('error', 'Não foi possível deletar esse registro.');
        }
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'name' => ['required', 'max:15'],
            'description' => ['required', 'string'],
            'permissions' => ['required']
        ];

        if (empty($primaryKey)) {
            array_push($rules['name'], Rule::unique('roles'));
        } else {
            array_push($rules['name'], Rule::unique('roles')->ignore($primaryKey));
        }

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
