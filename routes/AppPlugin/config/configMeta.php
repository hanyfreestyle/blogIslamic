<?php


use App\AppPlugin\Config\Meta\MetaTagController;
use Illuminate\Support\Facades\Route;

Route::get('/metaTags', [MetaTagController::class,'index'])->name('config.Meta.index');
Route::get('/metaTags/create', [MetaTagController::class,'create'])->name('config.Meta.create');
Route::get('/metaTags/edit/{id}', [MetaTagController::class,'edit'])->name('config.Meta.edit');
Route::post('/metaTags/Update/{id}', [MetaTagController::class,'storeUpdate'])->name('config.Meta.update');
Route::get('/metaTags/delete/{id}', [MetaTagController::class,'destroy'])->name('config.Meta.destroy');
Route::get('/metaTags/config', [MetaTagController::class,'config'])->name('config.Meta.config');
Route::get('/metaTags/emptyPhoto/{id}', [MetaTagController::class,'emptyPhoto'])->name('config.Meta.emptyPhoto');
Route::get('/metaTags/SoftDelete/',[MetaTagController::class,'SoftDeletes'])->name('config.Meta.SoftDelete');
Route::get('/metaTags/restore/{id}',[MetaTagController::class,'Restore'])->name('config.Meta.restore');
Route::get('/metaTags/force/{id}',[MetaTagController::class,'ForceDelete'])->name('config.Meta.force');

