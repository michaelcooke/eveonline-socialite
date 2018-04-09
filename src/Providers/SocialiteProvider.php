<?php

namespace MichaelCooke\EveOnlineSocialite\Providers;

use SocialiteProviders\Manager\OAuth2\User;
use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;

class SocialiteProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'EVEONLINE';

    /**
     * {@inheritdoc}
     */
    protected $scopes = [];

    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->getBaseUrl() . 'oauth/authorize', $state);
    }

    protected function getBaseUrl()
    {
        if (config('services.eveonline.datasource') == 'singularity') {
            return 'https://sisilogin.testeveonline.com/';
        }

        return 'https://login.eveonline.com/';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->getBaseUrl() . 'oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->getBaseUrl() . 'oauth/verify', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ],
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['CharacterID'],
            'nickname' => null,
            'name'     => $user['CharacterName'],
            'email'    => null,
            'avatar'   => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
