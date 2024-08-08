<?php


use App\AppPlugin\Crm\WordPress\WordPressController;
use Illuminate\Support\Facades\Route;

Route::get('/wordpress/',[WordPressController::class,'index'])->name('admin.wordpress.ImportPostsCategory');

Route::get('/wordpress/ImportCategory',[WordPressController::class,'ImportCategory'])->name('admin.ImportCategory');
Route::get('/wordpress/ImportTags',[WordPressController::class,'ImportTags'])->name('admin.ImportTags');
Route::get('/wordpress/ImportPosts',[WordPressController::class,'ImportPosts'])->name('admin.ImportPosts');


Route::get('/wordpress/CountSlug',[WordPressController::class,'CountSlug'])->name('admin.CountSlug');
Route::get('/wordpress/UpdateErrSlug',[WordPressController::class,'UpdateErrSlug'])->name('admin.UpdateErrSlug');
Route::get('/wordpress/UpdateErrSlugNew',[WordPressController::class,'UpdateErrSlugNew'])->name('admin.UpdateErrSlugNew');
Route::get('/wordpress/syncBlogCategory',[WordPressController::class,'syncBlogCategory'])->name('admin.syncBlogCategory');
Route::get('/wordpress/syncTags',[WordPressController::class,'syncTags'])->name('admin.syncTags');


Route::get('/wordpress/CheckId',[WordPressController::class,'CheckId'])->name('admin.CheckId');
Route::get('/wordpress/CheckUser',[WordPressController::class,'CheckUser'])->name('admin.CheckUser');
Route::get('/wordpress/Test',[WordPressController::class,'Test'])->name('admin.Test');
Route::get('/wordpress/TrimTags',[WordPressController::class,'TrimTags'])->name('admin.TrimTags');
Route::get('/wordpress/TrimBlogName',[WordPressController::class,'TrimBlogName'])->name('admin.TrimBlogName');
Route::get('/wordpress/DesText',[WordPressController::class,'DesText'])->name('admin.DesText');


Route::get('/wordpress/CleanBreakLine',[WordPressController::class,'CleanBreakLine'])->name('admin.CleanBreakLine');

Route::get('/wordpress/UpdateDates',[WordPressController::class,'UpdateDates'])->name('admin.UpdateDates');
