<?php

namespace App\Providers;

use App\Http\Controllers\RouteNotFoundController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider {


    public const HOME = '/';


    public function boot(): void {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));


            Route::group(['middleware' => ['auth', 'status']], function () {
                Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
                    Route::prefix(config('app.configAdminDir'))->name('admin.')->group(function () {
                        Route::middleware('web')->group(base_path('routes/adminCore/admin.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/admin_core.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/admin_roles.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/RouteData.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/RouteModel.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/RouteCrm.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/RouteConfig.php'));
                        Route::middleware('web')->group(base_path('routes/adminCore/RouteLeads.php'));
                    });
                });
            });

            if (File::isFile(base_path('routes/AppPlugin/customer.php'))) {
                Route::middleware('web')->group(base_path('routes/AppPlugin/customer.php'));
            }

            Route::middleware('web')->group(base_path('routes/web.php'));

        });

    }
}
