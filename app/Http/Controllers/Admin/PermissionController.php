<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Actions\Permission\ListPaginatedPermission;
use App\Actions\Permission\CreatePermission;
use App\Actions\Permission\FindOnePermission;
use App\Actions\Permission\UpdatePermission;
use App\Actions\Permission\DeletePermission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPaginatedPermission $action)
    {
        $permissions = $action->execute();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CreatePermission $action)
    {
        $this->validate($request, $this->rules($request));

        $action->execute($request->all());

        return redirect()->route('permissions.index')
            ->with('success', 'Registro adicionado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FindOnePermission $action)
    {
        $permission = $action->execute($id);

        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FindOnePermission $action)
    {
        $permission = $action->execute($id);

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, UpdatePermission $action)
    {
        $this->validate($request, $this->rules($request, $id));

        $action->execute($id, $request->all());

        return redirect()->route('permissions.index')
            ->with('success', 'Registro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeletePermission $action)
    {
        try {
            $action->execute($id);
            return redirect()->route('permissions.index')
                ->with('success', 'Registro atualizado com sucesso.');
        } catch (Exception $e) {
            return redirect()->route('permissions.index')
                ->with('error', 'Não foi possível deletar esse registro.');
        }
    }

    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'name' => [
                'required', 'max:40', Rule::unique('permissions')->ignore($primaryKey)
            ],
            'description' => ['required', 'string'],
        ];


        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
