<?php
use App\AppPlugin\Config\WebLangFile\LangFileWebController;
use Illuminate\Support\Facades\Route;

Route::get('/weblang',[LangFileWebController::class,'index'])->name('weblang.index');
Route::get('/weblang/edit',[LangFileWebController::class,'EditLang'])->name('weblang.edit');
Route::post('/weblang/updateFile',[LangFileWebController::class,'updateFile'])->name('weblang.updateFile');

