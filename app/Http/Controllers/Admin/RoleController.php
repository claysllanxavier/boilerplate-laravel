<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Permission\GetAllPermission;
use App\Actions\Role\CreateRole;
use App\Actions\Role\DeleteRole;
use App\Actions\Role\FindOneRole;
use App\Actions\Role\ListPaginatedRole;
use App\Actions\Role\UpdateRole;
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
    public function index(ListPaginatedRole $action)
    {
        $roles = $action->execute();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(GetAllPermission $action)
    {
        $permissions =  $action->execute();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreateRole $action)
    {
        $this->validate($request, $this->rules($request));

        $inputs = $request->all();

        $action->execute($inputs);

        return redirect()->route('roles.index')
            ->with('success', 'Registro adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FindOneRole $action)
    {
        $role = $action->execute($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FindOneRole $roleAction, GetAllPermission $permissionAction)
    {
        $role = $roleAction->execute($id);

        $permissions = $permissionAction->execute();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdateRole $action)
    {
        $this->validate($request, $this->rules($request, $id));

        $inputs = $request->all();

        $action->execute($id, $inputs);

        return redirect()->route('roles.index')
            ->with('success', 'Registro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeleteRole $action)
    {
        try {
            $action->execute($id);

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
            'name' => ['required', 'max:40', Rule::unique('roles')->ignore($primaryKey)],
            'description' => ['required', 'string'],
            'permissions' => ['required']
        ];

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
