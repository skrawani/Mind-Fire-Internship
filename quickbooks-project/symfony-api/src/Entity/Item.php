<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item", uniqueConstraints={@ORM\UniqueConstraint(name="itemId", columns={"itemId", "userId"})})
 * @ORM\Entity
 */
class Item
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
     * @ORM\Column(name="itemId", type="bigint", nullable=false)
     */
    private $itemid;

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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="fullyQualifiedName", type="string", length=50, nullable=false)
     */
    private $fullyqualifiedname;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="incomeAccountId", type="bigint", nullable=true)
     */
    private $incomeaccountid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="expenseAccountId", type="bigint", nullable=true)
     */
    private $expenseaccountid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="assetAccountId", type="bigint", nullable=true)
     */
    private $assetaccountid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="qtyOnHand", type="integer", nullable=true)
     */
    private $qtyonhand;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="invStartDate", type="date", nullable=true)
     */
    private $invstartdate;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="syncToken", type="string", length=2, nullable=false)
     */
    private $synctoken;

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
     */
    public function getItemid(): int
    {
        return $this->itemid;
    }

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullyqualifiedname(): string
    {
        return $this->fullyqualifiedname;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getIncomeaccountid(): ?int
    {
        return $this->incomeaccountid;
    }

    /**
     * @return int|null
     */
    public function getExpenseaccountid(): ?int
    {
        return $this->expenseaccountid;
    }

    /**
     * @return int|null
     */
    public function getAssetaccountid(): ?int
    {
        return $this->assetaccountid;
    }

    /**
     * @return int|null
     */
    public function getQtyonhand(): ?int
    {
        return $this->qtyonhand;
    }

    /**
     * @return DateTime|null
     */
    public function getInvstartdate(): ?DateTime
    {
        return $this->invstartdate;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getSynctoken(): string
    {
        return $this->synctoken;
    }

    /**
     * @return DateTime
     */
    public function getCreatedat(): DateTime
    {
        return $this->createdat;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }



}
