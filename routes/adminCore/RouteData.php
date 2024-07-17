<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/data/country.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/data/country.php'));
}
if (File::isFile(base_path('routes/AppPlugin/data/city.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/data/city.php'));
}

if (File::isFile(base_path('routes/AppPlugin/data/area.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/data/area.php'));
}

if (File::isFile(base_path('routes/AppPlugin/data/configData.php'))) {

    if (File::isFile(base_path('routes/AppPlugin/data/data_LeadCategory.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_LeadCategory.php'));
    }

    if (File::isFile(base_path('routes/AppPlugin/data/data_LeadSours.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_LeadSours.php'));
    }
    if (File::isFile(base_path('routes/AppPlugin/data/data_BrandName.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_BrandName.php'));
    }
    if (File::isFile(base_path('routes/AppPlugin/data/data_DeviceType.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_DeviceType.php'));
    }

    if (File::isFile(base_path('routes/AppPlugin/data/data_EvaluationCust.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_EvaluationCust.php'));
    }
    if (File::isFile(base_path('routes/AppPlugin/data/data_BookRelease.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_BookRelease.php'));
    }

    if (File::isFile(base_path('routes/AppPlugin/data/data_BookLang.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/data/data_BookLang.php'));
    }

}
