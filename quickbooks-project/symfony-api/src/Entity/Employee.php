<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee", uniqueConstraints={@ORM\UniqueConstraint(name="empId", columns={"empId", "userId"})}, indexes={@ORM\Index(name="empId_2", columns={"empId"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedat = 'CURRENT_TIMESTAMP';


}
