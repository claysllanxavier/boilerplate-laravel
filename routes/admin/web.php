<?php

use Illuminate\Support\Facades\Route;

/** Permissions */
Route::group(['prefix' => 'permissions'], function () {
    Route::get('', 'PermissionController@index')
        ->middleware('permission:permissions_view')
        ->name('permissions.index');
    Route::get('create', 'PermissionController@create')
        ->middleware('permission:permissions_create')
        ->name('permissions.create');
    Route::post('', 'PermissionController@store')
        ->middleware('permission:permissions_create')
        ->name('permissions.store');
    Route::get('/{id}', 'PermissionController@show')
        ->middleware('permission:permissions_view')
        ->name('permissions.show');
    Route::get('/{id}/edit', 'PermissionController@edit')
        ->middleware('permission:permissions_edit')
        ->name('permissions.edit');
    Route::put('/{id}', 'PermissionController@update')
        ->middleware('permission:permissions_edit')
        ->name('permissions.update');
    Route::delete('/{id}', 'PermissionController@destroy')
        ->middleware('permission:permissions_delete')
        ->name('permissions.destroy');
});

/** Roles */
Route::group(['prefix' => 'roles'], function () {
    Route::get('', 'RoleController@index')
        ->middleware('permission:roles_view')
        ->name('roles.index');
    Route::get('create', 'RoleController@create')
        ->middleware('permission:roles_create')
        ->name('roles.create');
    Route::post('', 'RoleController@store')
        ->middleware('permission:roles_create')
        ->name('roles.store');
    Route::get('/{id}', 'RoleController@show')
        ->middleware('permission:roles_view')
        ->name('roles.show');
    Route::get('/{id}/edit', 'RoleController@edit')
        ->middleware('permission:roles_edit')
        ->name('roles.edit');
    Route::put('/{id}', 'RoleController@update')
        ->middleware('permission:roles_edit')
        ->name('roles.update');
    Route::delete('/{id}', 'RoleController@destroy')
        ->middleware('permission:roles_delete')
        ->name('roles.destroy');
});

/** Users */
Route::group(['prefix' => 'users'], function () {
    Route::get('', 'UserController@index')
        ->middleware('permission:users_view')
        ->name('users.index');
    Route::get('create', 'UserController@create')
        ->middleware('permission:users_create')
        ->name('users.create');
    Route::post('', 'UserController@store')
        ->middleware('permission:users_create')
        ->name('users.store');
    Route::get('/{id}', 'UserController@show')
        ->middleware('permission:users_view')
        ->name('users.show');
    Route::get('/{id}/edit', 'UserController@edit')
        ->middleware('permission:users_edit')
        ->name('users.edit');
    Route::put('/{id}', 'UserController@update')
        ->middleware('permission:users_edit')
        ->name('users.update');
    Route::delete('/{id}', 'UserController@destroy')
        ->middleware('permission:users_delete')
        ->name('users.destroy');
});

/** Post Categories */
Route::group(['prefix' => 'post-categories'], function () {
    Route::get('', 'PostCategoryController@index')
        ->middleware('permission:post_categories_view')
        ->name('post_categories.index');
    Route::get('create', 'PostCategoryController@create')
        ->middleware('permission:post_categories_create')
        ->name('post_categories.create');
    Route::post('', 'PostCategoryController@store')
        ->middleware('permission:post_categories_create')
        ->name('post_categories.store');
    Route::get('/{id}', 'PostCategoryController@show')
        ->middleware('permission:post_categories_view')
        ->name('post_categories.show');
    Route::get('/{id}/edit', 'PostCategoryController@edit')
        ->middleware('permission:post_categories_edit')
        ->name('post_categories.edit');
    Route::put('/{id}', 'PostCategoryController@update')
        ->middleware('permission:post_categories_edit')
        ->name('post_categories.update');
    Route::delete('/{id}', 'PostCategoryController@destroy')
        ->middleware('permission:post_categories_delete')
        ->name('post_categories.destroy');
});
