<?php

namespace Oxygencms\Blocks;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * todo: load policy and model from config
     *
     * @var array
     */
    protected $policies = [
        \Oxygencms\Blocks\Models\Block::class => \Oxygencms\Blocks\Policies\BlockPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
