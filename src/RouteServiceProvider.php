<?php

namespace Oxygencms\Blocks\Providers;

use Validator;
use Oxygencms\Core\Rules\ClassExists;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::middleware(['web', 'admin'])
            ->prefix('admin')
            ->name('admin.')
            ->namespace('Oxygencms\Blocks\Controllers')
            ->group(function () {
                Route::resource('block', 'BlockController', ['except' => ['show', 'create']]);
            });
    }
}
