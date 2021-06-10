<?php

namespace App\EventListener;

use DateInterval;
use DateTime;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\Cookie;

class AuthenticationSuccessListener
{
    private $jwtTokenTTL;

    private $cookieSecure = false;

    public function __construct($ttl)
    {
        $this->jwtTokenTTL = $ttl;
    }


    /**
     * @param AuthenticationSuccessEvent $event
     * @return JWTAuthenticationSuccessResponse
     * @throws Exception
     */
    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): JWTAuthenticationSuccessResponse
    {
        /** @var JWTAuthenticationSuccessResponse $response */
        $response = $event->getResponse();
        $data = $event->getData();
        $tokenJWT = $data['token'];
        unset($data['token']);
//        $data['realmId'] = 12345;
//        unset($data['refresh_token']);
        $event->setData($data);

        $response->headers->setCookie(new Cookie('BEARER', $tokenJWT, (
        new DateTime())
            ->add(new DateInterval('PT' . $this->jwtTokenTTL . 'S')), '/', null, $this->cookieSecure));

        return $response;
    }
}