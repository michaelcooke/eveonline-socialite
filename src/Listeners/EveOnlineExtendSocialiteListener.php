<?php

namespace MichaelCooke\EveOnlineSocialite\Listeners;

use SocialiteProviders\Manager\SocialiteWasCalled;

class EveOnlineExtendSocialiteListener
{
    /**
     * Register the provider.
     *
     * @param \SocialiteProviders\Manager\SocialiteWasCalled $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'eveonline', 'MichaelCooke\EveOnlineSocialite\Providers\SocialiteProvider'
        );
    }
}
