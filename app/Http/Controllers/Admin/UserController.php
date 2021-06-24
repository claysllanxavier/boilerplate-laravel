<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\RoleRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected RoleRepositoryInterface $roleRepository
    ) {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getPaginated();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->getAll();

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

        $this->userRepository->create($inputs);

        return redirect()->route('users.index')
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
        $user = $this->userRepository->findOne($id);

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
        $user = $this->userRepository->findOne($id);

        $roles = $this->roleRepository->getAll();

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
        $this->validate($request, $this->rules($request, $id));

        $inputs = $request->all();

        $this->userRepository->update($id, $inputs);

        return redirect()->route('users.index')
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
            $this->userRepository->delete($id);
            return redirect()->route('users.index')
                ->with('success', __('messages.deleted'));
        } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', __('messages.deleted.fail'));
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
