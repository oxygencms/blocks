<?php

namespace Oxygencms\Blocks;

use Oxygencms\Blocks\Models\Block;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Oxygencms\Blocks\Observers\BlockObserver;
use Oxygencms\Blocks\Providers\RouteServiceProvider;

class BlockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Block::observe(BlockObserver::class);

        Blade::directive('block', function (string $expression) {
            return "<?php if ( ! App\Services\HtmlBlocks::setUp($expression) ) { ?>";
        });

        Blade::directive('endblock', function () {
            return "<?php } echo App\Services\HtmlBlocks::tearDown() ?>";
        });

        $this->loadViewsFrom(__DIR__.'/Views', 'oxygencms');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/oxygencms'),
        ], 'views');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register services.
     * +------------------
     *
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
    }
}
