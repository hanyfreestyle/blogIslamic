<?php

namespace App\Providers;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{

    public const HOME = '/';
    #public const HOME = '/ar/AppPanel/Home';
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();
        LogViewer::auth(function ($request) {
            return $request->user() && in_array($request->user()->email, ['test@test.com',]);}
        );

        //View::share('filterTypes', UploadFilter::all());
    }
}
