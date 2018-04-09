<?php

namespace MichaelCooke\EveOnlineSocialite;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EveOnlineSocialiteServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the package.
     *
     * @var array
     */
    protected $listen = [
        'SocialiteProviders\Manager\SocialiteWasCalled' => [
            'MichaelCooke\EveOnlineSocialite\Listeners\EveOnlineExtendSocialiteListener@handle',
        ],
    ];

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigurations();
    }

    /**
     * Merge package configurations.
     *
     * @return void
     */
    public function mergeConfigurations()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/services.php', 'services');
    }
}
