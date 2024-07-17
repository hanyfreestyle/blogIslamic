<?php


use App\AppPlugin\Config\Privacy\WebPrivacyController;
use Illuminate\Support\Facades\Route;

Route::get('/WebPrivacy', [WebPrivacyController::class,'index'])->name('config.WebPrivacy.index');
Route::get('/WebPrivacy/create', [WebPrivacyController::class,'create'])->name('config.WebPrivacy.create');
Route::get('/WebPrivacy/edit/{id}', [WebPrivacyController::class,'edit'])->name('config.WebPrivacy.edit');
Route::post('/WebPrivacy/Update/{id}', [WebPrivacyController::class,'storeUpdate'])->name('config.WebPrivacy.update');
Route::get('/WebPrivacy/delete/{id}', [WebPrivacyController::class,'destroy'])->name('config.WebPrivacy.destroy');
Route::get('/WebPrivacy/config', [WebPrivacyController::class,'config'])->name('config.WebPrivacy.config');
Route::get('/WebPrivacy/SoftDelete/',[WebPrivacyController::class,'SoftDeletes'])->name('config.WebPrivacy.SoftDelete');
Route::get('/WebPrivacy/restore/{id}',[WebPrivacyController::class,'Restore'])->name('config.WebPrivacy.restore');
Route::get('/WebPrivacy/force/{id}',[WebPrivacyController::class,'ForceDelete'])->name('config.WebPrivacy.force');
Route::get('/WebPrivacy/Sort',[WebPrivacyController::class,'Sort'])->name('config.WebPrivacy.Sort');
Route::post('/webPrivacy/SaveSort', [WebPrivacyController::class,'SaveSort'])->name('config.WebPrivacy.SaveSort');
