<?php


use App\AppPlugin\FileManager\FileBrowserController;
use App\AppPlugin\FileManager\FileManagerController;
use Illuminate\Support\Facades\Route;

Route::get('/fileBrowser/',[FileBrowserController::class,'FileBrowser'])->name('filebrowser.index');
Route::get('/fileBrowser/listphoto',[FileBrowserController::class,'ListPhoto'])->name('filebrowser.listPhoto');
Route::post('/fileBrowser/Upload', [FileBrowserController::class,'CkeditorUpload'])->name('fileBrowser.CkeditorUpload');

Route::get('/fileManager/',[FileManagerController::class,'index'])->name('fileManager.index');
Route::get('/fileManager/listDeletePhoto',[FileManagerController::class,'index'])->name('fileManager.listDeletePhoto');
Route::get('/fileManager/listphoto',[FileManagerController::class,'listphoto'])->name('fileManager.listphoto');
Route::get('/fileManager/listFolder',[FileManagerController::class,'listFolder'])->name('fileManager.listFolder');
Route::get('/fileManager/updateFolder',[FileManagerController::class,'updateFolder'])->name('fileManager.updateFolder');
Route::get('/fileManager/updatePhoto',[FileManagerController::class,'updatePhoto'])->name('fileManager.updatePhoto');

Route::get('/fileManager/addPhoto',[FileManagerController::class,'addPhoto'])->name('fileManager.addPhoto');
Route::post('/fileManager/UploadPhotos',[FileManagerController::class,'UploadPhotos'])->name('fileManager.UploadPhotos');
