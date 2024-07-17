<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/appCore.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/appCore.php'));
}
if (File::isFile(base_path('routes/AppPlugin/config/configMenu.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/configMenu.php'));
}

if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/configMeta.php'));
}
if (File::isFile(base_path('routes/AppPlugin/config/webPrivacy.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/webPrivacy.php'));
}
if (File::isFile(base_path('routes/AppPlugin/config/Branch.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/Branch.php'));
}
if (File::isFile(base_path('routes/AppPlugin/config/appSetting.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/appSetting.php'));
}

if (File::isFile(base_path('routes/AppPlugin/config/siteMaps.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/siteMaps.php'));
}

if (File::isFile(base_path('routes/AppPlugin/config/WebLangFile.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/config/WebLangFile.php'));
}



