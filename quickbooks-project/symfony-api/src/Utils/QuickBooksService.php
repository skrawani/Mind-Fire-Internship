<?php


namespace App\Utils;


use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Exception;


class QuickBooksService
{
    private $repository;
    private $doctrine;

    function __construct(ManagerRegistry $doctrine )
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository(User::class);
    }

    public function setAccessTokenAndRefreshToken($realmId, $accessTokenValue, $refreshTokenValue)
    {
        try {
            $em = $this->doctrine->getManager();
            $user = $this->repository->findOneBy(["realmid" => $realmId]);
            $user->setAccesstoken($accessTokenValue);
            $user->setRefreshtoken($refreshTokenValue);
            $user->setUpdatedat( new DateTime());
            $em->flush();

        } catch (Exception $e)
        {
            var_dump($e);
        }

    }

}