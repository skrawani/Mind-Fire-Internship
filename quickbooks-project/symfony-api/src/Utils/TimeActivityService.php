<?php


namespace App\Utils;


use App\Entity\TimeActivity;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class TimeActivityService
{
    private $repository;
    private $doctrine;
    private $user;


    function __construct(ManagerRegistry $doctrine, Security $security )
    {
        $this->doctrine = $doctrine;
        $this->repository = $this->doctrine->getRepository(TimeActivity::class);
        $this->user = $security->getUser();
    }

    public function getTimeActivitiesByUserID(): array
    {
        return $this->repository->findBy(["userid" => $this->user->getId()]);
    }

    public function getTimeActivitiesById($id): array
    {
        return $this->repository->findBy(["userid" => $this->user->getId(), "id" => $id]);
    }

    public function setTimeActivity($data ){
        $time_activity = new TimeActivity();
        $time_activity->setUserid($this->user->getId());
        $time_activity->setDomain($data['domain']?? "QBO");
        $time_activity->setNameof($data['nameOf']);
        $time_activity->setHours($data['hours']);
        $time_activity->setMinutes($data['minutes']);
        $time_activity->setHourlyrate($data['hourlyRate'] ?? 0 );
        $time_activity->setBillablestatus($data['billableStatus'] ?? null);
        $time_activity->setDescription($data['description'] ?? null);
        $time_activity->setItemid($data['itemId'] ?? null);
        $time_activity->setEmployeeid($data['employeeId'] ?? null);
        $time_activity->setVendorId($data['vendorId'] ?? null);
        $time_activity->setCustomerid($data['customerId'] ?? null);
        $time_activity->setTxndate($data['txnDate'] ?? new DateTime());
        $time_activity->setCreatedat(new DateTime());
        $time_activity->setUpdatedat(new DateTime());

        $em = $this->doctrine->getManager();
        $em->persist($time_activity);
        $em->flush();
    }

}