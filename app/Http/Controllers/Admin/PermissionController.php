<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Contracts\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    protected $permissionRepository;

    public function __construct(
        PermissionRepositoryInterface $permissionRepository
    ) {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissionRepository->getPaginated();

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
    public function store(Request $request)
    {
        $this->validate($request, $this->rules($request));

        $inputs = $request->all();
        $this->permissionRepository->create($inputs);

        return redirect()->route('permissions.index')
            ->with('success', __('messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->findOne($id);

        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->findOne($id);

        return view('permissions.edit', compact('permission'));
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
        $this->validate($request, $this->rules($request, $id));

        $inputs = $request->all();

        $this->permissionRepository->update($id, $inputs);

        return redirect()->route('permissions.index')
            ->with('success', __('messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->permissionRepository->delete($id);
            return redirect()->route('permissions.index')
                ->with('success', __('messages.deleted'));
        } catch (Exception $e) {
            return redirect()->route('permissions.index')
                ->with('error', __('messages.fail'));
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
