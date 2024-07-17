<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

if (File::isFile(base_path('routes/AppPlugin/model/mainPost.php'))) {

    if (File::isFile(base_path('routes/AppPlugin/model/blogPost.php'))) {
        Route::middleware('web')->group(base_path('routes/AppPlugin/model/blogPost.php'));
    }

}


if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/proProduct.php'));
}

if (File::isFile(base_path('routes/AppPlugin/faq.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/faq.php'));
}

if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/blogPost.php'));
}

if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/pages.php'));
}

if (File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/fileManager.php'));
}

if (File::isFile(base_path('routes/AppPlugin/orders.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/orders.php'));
}

if (File::isFile(base_path('routes/AppPlugin/customer_admin.php'))) {
    Route::middleware('web')->group(base_path('routes/AppPlugin/customer_admin.php'));
}
