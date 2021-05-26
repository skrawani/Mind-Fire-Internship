<?php


namespace App\Utils;
use App\Entity\Employee;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class EmployeeService
{
    private $repository;
    private $doctrine;
    private $userId;
    function __construct(ManagerRegistry $doctrine, Security $security )
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository(Employee::class);
        $this->userId = $security->getUser()->getId();
    }

    public function getEmployeesByUserID(): array
    {
        return $this->repository->findBy(["userid" => $this->userId]);
    }

    public  function getEmployeeByUserById($id): array
    {
        return $this->repository->findBy(["userid" => $this->userId, "id" => $id]);

    }

}