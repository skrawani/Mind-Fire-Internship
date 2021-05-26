<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\TimeActivityController;
use DateTime;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeActivity
 *
 * @ORM\Table(name="time_activity", uniqueConstraints={@ORM\UniqueConstraint(name="activityId", columns={"activityId", "userId"})})
 * @ORM\Entity
 * )
 */

class TimeActivity
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int| null
     *
     * @ORM\Column(name="activityId", type="bigint", nullable=false)
     */
    private $activityid;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="bigint", nullable=false)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=3, nullable=false, options={"default"="QBO"})
     */
    private $domain = 'QBO';

    /**
     * @var string
     *
     * @ORM\Column(name="nameOf", type="string", length=8, nullable=false)
     */
    private $nameof;

    /**
     * @var int
     *
     * @ORM\Column(name="hours", type="integer", nullable=false)
     */
    private $hours;

    /**
     * @var int
     *
     * @ORM\Column(name="minutes", type="integer", nullable=false)
     */
    private $minutes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="hourlyRate", type="bigint", nullable=true)
     */
    private $hourlyrate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="billableStatus", type="string", length=20, nullable=true)
     */
    private $billablestatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="itemId", type="bigint", nullable=true)
     */
    private $itemid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="employeeId", type="bigint", nullable=true)
     */
    private $employeeid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="vendorId", type="bigint", nullable=true)
     */
    private $vendorId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="customerId", type="bigint", nullable=true)
     */
    private $customerid;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="txnDate", type="date", nullable=true)
     */
    private $txndate;

    /**
     * @var string | null
     *
     * @ORM\Column(name="syncToken", type="string", length=3, nullable=false)
     */
    private $synctoken;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedat = 'CURRENT_TIMESTAMP';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return int
     */
    public function getActivityid(): ?int
    {
        return $this->activityid;
    }

    /**
     * @param int $activityid
     */
    public function setActivityid(int $activityid): void
    {
        $this->activityid = $activityid;
    }

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
    }

    /**
     * @param int $userid
     */
    public function setUserid(int $userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getNameof(): string
    {
        return $this->nameof;
    }

    /**
     * @param string $nameof
     */
    public function setNameof(string $nameof): void
    {
        $this->nameof = $nameof;
    }

    /**
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param int $hours
     */
    public function setHours(int $hours): void
    {
        $this->hours = $hours;
    }

    /**
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @param int $minutes
     */
    public function setMinutes(int $minutes): void
    {
        $this->minutes = $minutes;
    }

    /**
     * @return int|null
     */
    public function getHourlyrate(): ?int
    {
        return $this->hourlyrate;
    }

    /**
     * @param int|null $hourlyrate
     */
    public function setHourlyrate(?int $hourlyrate): void
    {
        $this->hourlyrate = $hourlyrate;
    }

    /**
     * @return string|null
     */
    public function getBillablestatus(): ?string
    {
        return $this->billablestatus;
    }

    /**
     * @param string|null $billablestatus
     */
    public function setBillablestatus(?string $billablestatus): void
    {
        $this->billablestatus = $billablestatus;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getItemid(): ?int
    {
        return $this->itemid;
    }

    /**
     * @param int|null $itemid
     */
    public function setItemid(?int $itemid): void
    {
        $this->itemid = $itemid;
    }

    /**
     * @return int|null
     */
    public function getEmployeeid(): ?int
    {
        return $this->employeeid;
    }

    /**
     * @param int|null $employeeid
     */
    public function setEmployeeid(?int $employeeid): void
    {
        $this->employeeid = $employeeid;
    }

    /**
     * @return int|null
     */
    public function getCustomerid(): ?int
    {
        return $this->customerid;
    }

    /**
     * @return int|null
     */
    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }

    /**
     * @param int|null $vendorId
     */
    public function setVendorId(?int $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @param int|null $customerid
     */
    public function setCustomerid(?int $customerid): void
    {
        $this->customerid = $customerid;
    }

    /**
     * @return DateTime|null
     */
    public function getTxndate(): ?DateTime
    {
        return $this->txndate;
    }

    /**
     * @param DateTime|null $txndate
     */
    public function setTxndate(?DateTime $txndate): void
    {
        $this->txndate = $txndate;
    }

    /**
     * @return string
     */
    public function getSynctoken(): ?string
    {
        return $this->synctoken;
    }

    /**
     * @param string $synctoken
     */
    public function setSynctoken(string $synctoken): void
    {
        $this->synctoken = $synctoken;
    }

    /**
     * @return DateTime
     */
    public function getCreatedat(): DateTime
    {
        return $this->createdat;
    }

    /**
     * @param DateTime $createdat
     */
    public function setCreatedat(DateTime $createdat): void
    {
        $this->createdat = $createdat;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * @param DateTime|null $updatedat
     */
    public function setUpdatedat($updatedat): void
    {
        $this->updatedat = $updatedat;
    }



}
