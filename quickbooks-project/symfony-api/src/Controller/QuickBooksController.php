<?php


namespace App\Controller;

use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Exception\SdkException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QuickBooks
 * @package App\Controller
 * @Route("/api/qb")
 */
class QuickBooks extends  AbstractController
{
    private  $dataService;

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

    /**
     * @Route("/")
     *
     */
    public function test(): JsonResponse
    {
        return $this->json('hey');
    }
    public function  getDataService(): DataService
    {
        return $this->dataService;
    }

    /**
     * @Route("/callback)
     */
    public function callback(){

    }

}