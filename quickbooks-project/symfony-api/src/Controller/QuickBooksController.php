<?php


namespace App\Controller;

use App\Utils\QuickBooksService;
use QuickBooksOnline\API\Exception\SdkException;
use QuickBooksOnline\API\Exception\ServiceException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use App\QuickBooks\QuickBooks;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class QuickBooksController
 * @package App\Controller
 * @Route("/api/qb")
 */
class QuickBooksController extends AbstractController
{
    private  $dataService;

    public function __construct(QuickBooks $quickBooks)
    {
       $this->dataService = $quickBooks->getDataService();
    }

    /**
     * @Route("/load")
     */
    public function test(): JsonResponse
    {
        try {
            $process = new Process(['/home/sachin/Documents/Mind-Fire-Internship/quickbooks-project/server/scripts/fetchCronScript.sh']);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            return $this->json(["success" => true, "err" => ""]);
        }
        catch (ProcessFailedException $ex) {
            return $this->json(["success" => false, "err" => $ex]);
        }

    }

    /**
     * @Route("/authenticate")
     */
    public function authenticate(): JsonResponse
    {
        $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
        $authorizationUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
       return $this->json(urlencode($authorizationUrl));
    }


    /**
     * @Route("/callback")
     */
    public function callback(Request $request,QuickBooksService $service ): Response
    {
        $query = $request->query;

        $OAuth2LoginHelper = $this->dataService->getOAuth2LoginHelper();
        try {
            $accessTokenObj = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($query->get("code"), $query->get("realmId"));
            $this->dataService->updateOAuth2Token($accessTokenObj);
            $accessTokenValue = $accessTokenObj->getAccessToken();
            $refreshTokenValue = $accessTokenObj->getRefreshToken();
            $realmId = $accessTokenObj->getRealmID();
            $service->setAccessTokenAndRefreshToken($realmId, $accessTokenValue, $refreshTokenValue);
        } catch (SdkException | ServiceException $e) {
            var_dump($e);
        }
        return new Response();
    }

}