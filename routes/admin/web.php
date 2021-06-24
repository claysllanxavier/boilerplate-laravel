<?php

use App\Http\Controllers\Admin\ChangePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;


/** Change Password */
Route::group(['prefix' => 'change-password'], function () {
    Route::get('', [ChangePasswordController::class, 'edit'])
        ->name('change-password.edit');
    Route::put('', [ChangePasswordController::class, 'update'])
        ->name('change-password.update');
});

/** Permissions */
Route::group(['prefix' => 'permissions'], function () {
    Route::get('', [PermissionController::class, 'index'])
        ->middleware('permission:permissions_view')
        ->name('permissions.index');
    Route::get('create', [PermissionController::class, 'create'])
        ->middleware('permission:permissions_create')
        ->name('permissions.create');
    Route::post('', [PermissionController::class, 'store'])
        ->middleware('permission:permissions_create')
        ->name('permissions.store');
    Route::get('/{id}', [PermissionController::class, 'show'])
        ->middleware('permission:permissions_view')
        ->name('permissions.show');
    Route::get('/{id}/edit', [PermissionController::class, 'edit'])
        ->middleware('permission:permissions_edit')
        ->name('permissions.edit');
    Route::put('/{id}', [PermissionController::class, 'update'])
        ->middleware('permission:permissions_edit')
        ->name('permissions.update');
    Route::delete('/{id}', [PermissionController::class, 'destroy'])
        ->middleware('permission:permissions_delete')
        ->name('permissions.destroy');
});

/** Roles */
Route::group(['prefix' => 'roles'], function () {
    Route::get('', [RoleController::class, 'index'])
        ->middleware('permission:roles_view')
        ->name('roles.index');
    Route::get('create', [RoleController::class, 'create'])
        ->middleware('permission:roles_create')
        ->name('roles.create');
    Route::post('', [RoleController::class, 'store'])
        ->middleware('permission:roles_create')
        ->name('roles.store');
    Route::get('/{id}', [RoleController::class, 'show'])
        ->middleware('permission:roles_view')
        ->name('roles.show');
    Route::get('/{id}/edit', [RoleController::class, 'edit'])
        ->middleware('permission:roles_edit')
        ->name('roles.edit');
    Route::put('/{id}', [RoleController::class, 'update'])
        ->middleware('permission:roles_edit')
        ->name('roles.update');
    Route::delete('/{id}', [RoleController::class, 'destroy'])
        ->middleware('permission:roles_delete')
        ->name('roles.destroy');
});

/** Users */
Route::group(['prefix' => 'users'], function () {
    Route::get('', [UserController::class, 'index'])
        ->middleware('permission:users_view')
        ->name('users.index');
    Route::get('create', [UserController::class, 'create'])
        ->middleware('permission:users_create')
        ->name('users.create');
    Route::post('', [UserController::class, 'store'])
        ->middleware('permission:users_create')
        ->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])
        ->middleware('permission:users_view')
        ->name('users.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])
        ->middleware('permission:users_edit')
        ->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])
        ->middleware('permission:users_edit')
        ->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])
        ->middleware('permission:users_delete')
        ->name('users.destroy');
});
