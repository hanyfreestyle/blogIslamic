<?php


use App\AppPlugin\Crm\WordPress\WordPressController;
use Illuminate\Support\Facades\Route;

Route::get('/wordpress/',[WordPressController::class,'index'])->name('admin.wordpress.ImportPostsCategory');

Route::get('/wordpress/ImportCategory',[WordPressController::class,'ImportCategory'])->name('admin.ImportCategory');
Route::get('/wordpress/ImportTags',[WordPressController::class,'ImportTags'])->name('admin.ImportTags');
Route::get('/wordpress/ImportPosts',[WordPressController::class,'ImportPosts'])->name('admin.ImportPosts');


Route::get('/wordpress/CountSlug',[WordPressController::class,'CountSlug'])->name('admin.CountSlug');
Route::get('/wordpress/UpdateErrSlug',[WordPressController::class,'UpdateErrSlug'])->name('admin.UpdateErrSlug');
Route::get('/wordpress/syncBlogCategory',[WordPressController::class,'syncBlogCategory'])->name('admin.syncBlogCategory');
Route::get('/wordpress/syncTags',[WordPressController::class,'syncTags'])->name('admin.syncTags');


Route::get('/wordpress/CheckId',[WordPressController::class,'CheckId'])->name('admin.CheckId');
Route::get('/wordpress/CheckUser',[WordPressController::class,'CheckUser'])->name('admin.CheckUser');

