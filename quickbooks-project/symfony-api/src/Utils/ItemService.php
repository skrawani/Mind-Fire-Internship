<?php


namespace App\Utils;
use App\Entity\Item;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class ItemService
{
    private $repository;
    private $doctrine;
    private $userId;
    function __construct(ManagerRegistry $doctrine, Security $security )
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository(Item::class);
        $this->userId = $security->getUser()->getId();
    }

    public function getItemsByUserID(): array
    {
        return $this->repository->findBy(["userid" => $this->userId]);
    }

    public  function getItemsByUserById($id): array
    {
        return $this->repository->findBy(["userid" => $this->userId, "id" => $id]);
    }
}