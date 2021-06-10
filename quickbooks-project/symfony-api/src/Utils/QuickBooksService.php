<?php


namespace App\Utils;


use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\Security\Core\Security;


class QuickBooksService
{
    private $repository;
    private $doctrine;
    private  $user;
    function __construct(ManagerRegistry $doctrine , Security $security)
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository(User::class);
        $this->user = $security->getUser();
    }

    public function isFirstLoginChecker(): bool
    {
        $realmid = $this->user->getRealmid();
        return $realmid == null;

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