<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

//Client routes
Route::get('/', function () {
    return view('auth.login');
});
// administration routes
Auth::routes(['verify'=> true]);
//Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'widgets'])->name('home');
    // roles routes
    /* Route::get('roles', [RoleController::class,'indexRoles'])->name('index.roles');
    Route::post('role-create', [RoleController::class,'storeRole'])->name('create.role');
    Route::post('role-delete', [RoleController::class,'destroyRole'])->name('delete.role');
    Route::post('role-edit', [RoleController::class,'editRole'])->name('edit.role');
    Route::post('role-update', [RoleController::class,'updateRole'])->name('update.role'); */
    Route::resource('roles', RoleController::class);
    // permissions routes
    //Route::resource('permissions', PermissionController::class);
    Route::get('permissions', [PermissionController::class,'indexPermissions'])->name('index.permissions');
    Route::post('edit-permission', [PermissionController::class,'editPermission'])->name('edit.permission');
    Route::post('update-permission', [PermissionController::class,'updatePermission'])->name('update.permission');
    Route::post('permission-create', [PermissionController::class,'storePermission'])->name('create.permission');
    Route::post('permission-delete', [PermissionController::class,'destroyPermission'])->name('delete.permission');
    Route::resource('posts', PostController::class);
    //user routes
    Route::post('user-details', [UserController::class,'getUser'])->name('show.user');
    Route::post('user-create', [UserController::class,'storeUser'])->name('create.user');
    Route::get('users', [UserController::class,'indexUsers'])->name('index.users');
    Route::post('user-delete', [UserController::class,'destroyUser'])->name('delete.user');
    Route::post('edit-details', [UserController::class,'editUser'])->name('edit.user');
    Route::post('update-user', [UserController::class,'updateUser'])->name('update.user');

    //posts routes
    Route::post('post-delete', [PostController::class,'destroyPost'])->name('post.delete');
    Route::post('post-update', [PostController::class,'updatePost'])->name('post.update');
    Route::get('post-get', [PostController::class,'getPost'])->name('post.get');
});
