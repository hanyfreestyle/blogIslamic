<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HooverDataController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::get('/change-collapse', [DashboardController::class, 'ChangeCollapse'])->name('ChangeCollapse');


if (File::isFile(base_path('app\AppPlugin\Crm\Periodicals\BookDashboardController.php'))) {

} else {
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('Dashboard');
}

Route::get('/testpdf', [DashboardController::class, 'testpdf'])->name('testpdf');
Route::get('/getConfigData', [HooverDataController::class, 'getConfigData'])->name('getConfigData');






