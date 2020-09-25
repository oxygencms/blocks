<?php

namespace Oxygencms\Blocks;

use Oxygencms\Blocks\Models\Block;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Oxygencms\Blocks\Observers\BlockObserver;

class BlockServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'oxygencms');

        $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/oxygencms'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations')
        ], 'migrations');

        Block::observe(BlockObserver::class);

        Blade::directive('block', function (string $expression) {
            return "<?php if ( ! Oxygencms\Blocks\Services\HtmlBlocks::setUp($expression) ) { ?>";
        });

        Blade::directive('endblock', function () {
            return "<?php } echo Oxygencms\Blocks\Services\HtmlBlocks::tearDown() ?>";
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->register(AuthServiceProvider::class);
    }
}
