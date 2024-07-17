<?php

use App\AppPlugin\Customers\ShoppingCartController;
use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\RouteNotFoundController;
use App\Http\Controllers\web\BlogViewController;
use App\Http\Controllers\web\BrandViewController;
use App\Http\Controllers\web\MainPagesViewController;
use App\Http\Controllers\web\PagesViewController;
use App\Http\Controllers\web\ProductsCategoriesViewController;
use App\Http\Controllers\web\ProductsPageController;
use App\Http\Controllers\web\ProductsViewController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['prefix' => config('app.configAdminDir')], function () {
        Route::get('/admin-login', [AuthAdminController::class, 'AdminLogIn'])->name('admin.login');
        Route::post('/loginCheck', [AuthAdminController::class, 'AdminLoginCheck'])->name('AdminLoginCheck');
        Route::post('/logout', [AuthAdminController::class, 'AdminLogout'])->name('admin.logout');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/under-construction', [PagesViewController::class, 'UnderConstruction'])->name('UnderConstruction');
});


Route::group(['middleware' => ['UnderConstruction','MinifyHtml']], function() {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
        Route::get('/', [MainPagesViewController::class, 'index'])->name('page_index');
        Route::get('/categories', [MainPagesViewController::class, 'categories'])->name('categories_list');
        Route::get('/category/{slug}', [MainPagesViewController::class, 'CategoryView'])->name('CategoryView');
        Route::get('/tag/{slug}', [MainPagesViewController::class, 'TagView'])->name('TagView');
        Route::get('/author/{slug}', [MainPagesViewController::class, 'AuthorView'])->name('AuthorView');
        Route::get('/معايير-تدقيق-المحتوى', [MainPagesViewController::class, 'PageReview'])->name('PageReview');
        Route::get('/من-نحن', [MainPagesViewController::class, 'PageAbout'])->name('PageAbout');
        Route::get('/سياسية-الاستخدام', [MainPagesViewController::class, 'PagePrivacy'])->name('PagePrivacy');

        Route::get('{slug}{extension}', [MainPagesViewController::class, 'BlogView'])
            ->name('blog_view')->where('slug', '(.*)')->where('extension', '(?:.html)?');
    });
});

Route::fallback(RouteNotFoundController::class);

