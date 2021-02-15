<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Actions\PostCategory\CreatePostCategory;
use App\Actions\PostCategory\DeletePostCategory;
use App\Actions\PostCategory\FindOnePostCategory;
use App\Actions\PostCategory\ListPaginatedPostCategory;
use App\Actions\PostCategory\UpdatePostCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryRequest;

class PostCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:post_categories_view', ['only' => ['show', 'index']]);
        $this->middleware('permission:post_categories_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post_categories_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post_categories_delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListPaginatedPostCategory $action)
    {
        $categories = $action->execute();

        return view('post-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request, CreatePostCategory $action)
    {
        $inputs = $request->all();

        $action->execute($inputs);

        return redirect()->route('post_categories.index')
            ->with('success', __('messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, FindOnePostCategory $action)
    {
        $postCategory = $action->execute($id);

        return view('post-categories.show', compact('postCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, FindOnePostCategory $action)
    {
        $postCategory = $action->execute($id);

        return view('post-categories.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCategoryRequest $request, $id, UpdatePostCategory $action)
    {
        $inputs = $request->all();

        $action->execute($id, $inputs);

        return redirect()->route('post_categories.index')
            ->with('success', __('messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeletePostCategory $action)
    {
        try {
            $action->execute($id);
            return redirect()->route('post_categories.index')
                ->with('success', __('messages.deleted'));
        } catch (Exception $e) {
            return redirect()->route('post_categories.index')
                ->with('error', __('messages.fail'));
        }
    }
}
