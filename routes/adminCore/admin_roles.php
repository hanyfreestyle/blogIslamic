<?php


use App\AppCore\AdminRole\PermissionController;
use App\AppCore\AdminRole\RoleController;
use App\AppCore\AdminRole\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/Users', [UserController::class, 'index'])->name('users.UserList.index');
Route::get('/Users/SoftDelete', [UserController::class, 'SoftDeletes'])->name('users.UserList.SoftDelete');
Route::get('/Users/restore/{id}', [UserController::class, 'Restore'])->name('users.UserList.restore');
Route::get('/Users/force/{id}', [UserController::class, 'ForceDelete'])->name('users.UserList.force');
Route::get('/Users/create', [UserController::class, 'create'])->name('users.UserList.create');
Route::post('/Users/store/{id}', [UserController::class, 'storeUpdate'])->name('users.UserList.store');
Route::get('/Users/edit/{id}', [UserController::class, 'edit'])->name('users.UserList.edit');
Route::post('/Users/Update/{id}', [UserController::class, 'storeUpdate'])->name('users.UserList.update');
Route::get('/Users/delete/{id}', [UserController::class, 'destroy'])->name('users.UserList.destroy');
Route::post('/Users/updateStatus', [UserController::class, 'updateStatus'])->name('users.UserList.updateStatus');
Route::get('/Users/emptyPhoto/{id}', [UserController::class, 'emptyPhoto'])->name('users.UserList.emptyPhoto');
Route::get('/Users/config', [UserController::class, 'config'])->name('users.UserList.config');


Route::get('/Roles', [RoleController::class, 'index'])->name('users.roles.index');
Route::get('/Roles/create', [RoleController::class, 'create'])->name('users.roles.create');
Route::get('/Roles/edit/{id}', [RoleController::class, 'edit'])->name('users.roles.edit');
Route::get('/Roles/delete/{id}', [RoleController::class, 'destroy'])->name('users.roles.destroy');
Route::post('/Roles/Update/{id}', [RoleController::class, 'storeUpdate'])->name('users.roles.update');
Route::get('/Roles/editRoleToPermission/{id}', [RoleController::class, 'editRoleToPermission'])->name('users.roles.editRoleToPermission');
Route::post('/Roles/givePermission', [RoleController::class, 'givePermission'])->name('users.roles.givePermission');
Route::get('/Roles/config', [RoleController::class, 'config'])->name('users.roles.config');


Route::get('/Permissions', [PermissionController::class, 'index'])->name('users.permissions.index');
Route::get('/Permissions/create', [PermissionController::class, 'create'])->name('users.permissions.create');
Route::get('/Permissions/edit/{id}', [PermissionController::class, 'edit'])->name('users.permissions.edit');
Route::get('/Permissions/delete/{id}', [PermissionController::class, 'destroy'])->name('users.permissions.destroy');
Route::post('/Permissions/Update/{id}', [PermissionController::class, 'storeUpdate'])->name('users.permissions.update');
Route::get('/Permissions/config', [PermissionController::class, 'config'])->name('users.permissions.config');
