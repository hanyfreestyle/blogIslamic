<?php

use App\AppPlugin\Config\SiteMap\SiteMapController;
use Illuminate\Support\Facades\Route;

Route::get('/config/SiteMap', [SiteMapController::class, 'index'])->name('config.SiteMap.index');
Route::post('/config/SiteMap/Update', [SiteMapController::class, 'UpdateSiteMap'])->name('config.SiteMap.Update');

