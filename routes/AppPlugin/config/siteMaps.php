<?php

use App\AppPlugin\Config\SiteMap\SiteMapController;
use Illuminate\Support\Facades\Route;

Route::get('/config/SiteMap', [SiteMapController::class, 'index'])->name('config.SiteMap.index');
Route::post('/config/SiteMap/Update', [SiteMapController::class, 'UpdateSiteMap'])->name('config.SiteMap.Update');

Route::get('/config/robots', [SiteMapController::class, 'Robots'])->name('config.SiteMap.Robots');
Route::post('/config/robots/update', [SiteMapController::class, 'RobotsUpdate'])->name('config.SiteMap.RobotsUpdate');

Route::get('/config/google-code', [SiteMapController::class, 'GoogleCode'])->name('config.SiteMap.GoogleCode');
Route::post('/config/google-code/update', [SiteMapController::class, 'GoogleCodeUpdate'])->name('config.SiteMap.GoogleCodeUpdate');
