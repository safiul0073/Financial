<?php

namespace App\Providers;

use App\View\Composer\ExpenseCategoryComposer;
use App\View\Composer\IncomeCategoryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['content.report.expense.index'], ExpenseCategoryComposer::class);
        View::composer(['content.report.incame.index'], IncomeCategoryComposer::class);
    }
}
