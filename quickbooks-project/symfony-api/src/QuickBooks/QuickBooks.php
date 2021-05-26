<?php


namespace App\QuickBooks;


use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2AccessToken;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Exception\SdkException;
use Symfony\Component\Dotenv\Dotenv;

class QuickBooks
{
    private $dataService;


    /**
     * @throws SdkException
     */
    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');
        $this->dataService = DataService::Configure([
            'auth_mode' => 'oauth2',
            'ClientID' => $_ENV['client_id'],
            'ClientSecret' =>  $_ENV['client_secret'],
            'RedirectURI' => $_ENV['oauth_redirect_uri'],
            'scope' => $_ENV['oauth_scope'],
            'baseUrl' => "development"
        ]);

    }
    public function getDataService(): DataService
    {
        return $this->dataService;
    }

    public function getCredentials(): array
    {
        return['client_id' => $_ENV['client_id'], 'client_secret' =>  $_ENV['client_secret']];
    }
}