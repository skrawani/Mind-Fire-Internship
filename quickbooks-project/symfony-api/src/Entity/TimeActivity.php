<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeActivity
 *
 * @ORM\Table(name="time_activity", uniqueConstraints={@ORM\UniqueConstraint(name="activityId", columns={"activityId", "userId"})})
 * @ORM\Entity
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
     * @var int
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
     * @ORM\Column(name="customerId", type="bigint", nullable=true)
     */
    private $customerid;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="txnDate", type="date", nullable=true)
     */
    private $txndate;

    /**
     * @var string
     *
     * @ORM\Column(name="syncToken", type="string", length=3, nullable=false)
     */
    private $synctoken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedat = 'CURRENT_TIMESTAMP';


}
