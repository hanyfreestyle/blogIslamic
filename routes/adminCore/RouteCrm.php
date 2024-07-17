<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/crm/customers.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/customers.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/ImportData.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/ImportData.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/Periodicals.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/Periodicals.php'));
}

if (File::isFile(base_path('routes/AppPlugin/crm/WordPress.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/crm/WordPress.php'));
}



