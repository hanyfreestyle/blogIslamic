<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


if (File::isFile(base_path('routes/AppPlugin/leads/contactUs.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/leads/contactUs.php'));
}
if (File::isFile(base_path('routes/AppPlugin/leads/newsLetter.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/leads/newsLetter.php'));
}
