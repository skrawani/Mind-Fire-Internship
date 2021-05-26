<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\TimeActivityController;
use DateTime;
use Doctrine\ORM\Mapping as ORM;



/**
 * Employee
 *
 * @ORM\Table(name="employee",  uniqueConstraints={@ORM\UniqueConstraint(name="empId", columns={"empId", "userId"})}, indexes={@ORM\Index(name="empId_2", columns={"empId"})})
 * @ORM\Entity
 */
class Employee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="empId", type="bigint", nullable=false)
     */
    private $empid;

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
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="displayName", type="string", length=500, nullable=false)
     */
    private $displayname;

    /**
     * @var string
     *
     * @ORM\Column(name="familyName", type="string", length=100, nullable=false)
     */
    private $familyname;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="billableTime", type="boolean", nullable=true)
     */
    private $billabletime = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="syncToken", type="string", length=3, nullable=false)
     */
    private $synctoken;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
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
     *
     */
    public function getEmpid(): int
    {
        return $this->empid;
    }

    /**
     * @param int $empid
     */
    public function setEmpid(int $empid): void
    {
        $this->empid = $empid;
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
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getDisplayname(): string
    {
        return $this->displayname;
    }

    /**
     * @param string $displayname
     */
    public function setDisplayname(string $displayname): void
    {
        $this->displayname = $displayname;
    }

    /**
     * @return string
     */
    public function getFamilyname(): string
    {
        return $this->familyname;
    }

    /**
     * @param string $familyname
     */
    public function setFamilyname(string $familyname): void
    {
        $this->familyname = $familyname;
    }

    /**
     * @return bool|null
     */
    public function getBillabletime()
    {
        return $this->billabletime;
    }

    /**
     * @param bool|null $billabletime
     */
    public function setBillabletime($billabletime): void
    {
        $this->billabletime = $billabletime;
    }

    /**
     * @return string
     */
    public function getSynctoken(): string
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
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
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
     * @return DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * @param DateTime $updatedat
     */
    public function setUpdatedat($updatedat): void
    {
        $this->updatedat = $updatedat;
    }

}
