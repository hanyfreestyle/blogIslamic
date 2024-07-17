<?php

use App\AppCore\DefPhoto\DefPhotoController;
use App\AppCore\LangFile\LangFileController;

use App\AppCore\Menu\AdminMenuController;
use App\AppCore\UploadFilter\UploadFilterController;
use App\AppCore\UploadFilter\UploadFilterSizeController;


use App\AppCore\WebSettings\SettingsController;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\Route;

Route::post('/config/update', [AdminMainController::class, 'ConfigModelUpdate'])->name('config.model.update');
Route::post('/ForgetSession', [AdminMainController::class, 'ForgetSession'])->name('ForgetSession');

Route::get('/adminlang',[LangFileController::class,'index'])->name('adminlang.index');
Route::get('/adminlang/edit',[LangFileController::class,'EditLang'])->name('adminlang.edit');
Route::post('/adminlang/updateFile',[LangFileController::class,'updateFile'])->name('adminlang.updateFile');



Route::get('/config/webConfig', [SettingsController::class, 'webConfigEdit'])->name('config.web.index');
Route::post('/config/webConfigUpdate', [SettingsController::class, 'webConfigUpdate'])->name('webConfigUpdate');


Route::get('/defPhotos', [DefPhotoController::class,'index'])->name('config.defPhoto.index');
Route::get('/sortDefPhoto/ListAll', [DefPhotoController::class,'sortDefPhotoList'])->name('config.defPhoto.sortDefPhotoList');
Route::get('/defPhotos/create', [DefPhotoController::class,'create'])->name('config.defPhoto.create');
Route::get('/defPhotos/edit/{id}', [DefPhotoController::class,'edit'])->name('config.defPhoto.edit');
Route::get('/defPhotos/delete/{id}', [DefPhotoController::class,'destroy'])->name('config.defPhoto.destroy');
Route::post('/defPhotos/store/{id}', [DefPhotoController::class,'storeUpdate'])->name('config.defPhoto.storeUpdate');
Route::post('/sortDefPhoto/saveSort', [DefPhotoController::class,'sortDefPhotoSave'])->name('config.defPhoto.sortDefPhoto');

Route::get('/upFilter', [UploadFilterController::class,'index'])->name('config.upFilter.index');
Route::get('/upFilter/create', [UploadFilterController::class,'create'])->name('config.upFilter.create');
Route::get('/upFilter/edit/{id}', [UploadFilterController::class,'edit'])->name('config.upFilter.edit');
Route::get('/upFilter/delete/{id}', [UploadFilterController::class,'destroy'])->name('config.upFilter.destroy');
Route::post('/upFilter/Update/{id}', [UploadFilterController::class,'storeUpdate'])->name('config.upFilter.update');
Route::get('/upFilter/config', [UploadFilterController::class,'config'])->name('config.upFilter.config');
Route::get('/upFilter/SoftDelete/',[UploadFilterController::class,'SoftDeletes'])->name('config.upFilter.SoftDelete');
Route::get('/upFilter/restore/{id}',[UploadFilterController::class,'Restore'])->name('config.upFilter.restore');
Route::get('/upFilter/force/{id}',[UploadFilterController::class,'ForceDelete'])->name('config.upFilter.force');

Route::get('/upFilterSize/create/{filterId}', [UploadFilterSizeController::class,'create'])->name('config.upFilter.size.create');
Route::get('/upFilterSize/edit/{id}', [UploadFilterSizeController::class,'edit'])->name('config.upFilter.size.edit');
Route::get('/upFilterSize/delete/{id}', [UploadFilterSizeController::class,'destroy'])->name('config.upFilter.size.destroy');
Route::post('/upFilterSize/store/{id}', [UploadFilterSizeController::class,'storeUpdate'])->name('config.upFilter.size.storeOrUpdate');

Route::get('/clearCash/',[SettingsController::class,'clearCash'])->name('cash.index');

Route::get('/menu/', [AdminMenuController::class,'index'])->name('AdminMenu.index');
Route::get('/menu/sub/{id}', [AdminMenuController::class,'subIndex'])->name('AdminMenu.sub');
Route::post('/menu/SaveSort',[AdminMenuController::class,'SaveSort'])->name('AdminMenu.SaveSort');
Route::post('/menu/updateStatus', [AdminMenuController::class,'updateStatus'])->name('AdminMenu.updateStatus');
