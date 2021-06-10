<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="unq_realmid", columns={"realmId"}),
 *     @ORM\UniqueConstraint(name="unq_username",columns={"username"})})
 * @ORM\Entity
 *  @ApiResource(
 *      itemOperations={"GET",
 *          "put"={
 *              "method"="PUT",
 *               "denormalization_context"={
 *                   "groups"={"put"}
 *                  }
 *              }
 *      },
 *      collectionOperations={"GET", "POST"},
 *      normalizationContext={
 *          "groups"={"read"}
 *      }
 * )
 */
class User implements  UserInterface
{


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Groups({"read","put"})
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length( max=255)
     * @Groups({"read","put"})
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100, nullable=false   )
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=255)
     * @Groups({"read"})
     */
    private $username;


    /**
     * @ORM\Column(type="string", length=225)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *      pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
     *      message="Passwords must be at least 7 characters long and contain at least one digit, one uppercaseletter, and one lowercase letter"
     * )
     * @Groups({"put"})
     */
    private $password;

    /**
     * @var bool | null
     *
     * @ORM\Column(name="active", type="boolean", nullable=false, options={"default"="1"})
     * @Groups({"read"})
     */

    private $active = true;

    /**
     * @var string | null
     *
     * @ORM\Column(name="realmId", type="string", length=50, nullable=true)
     * @Groups({"read"})
     */
    private $realmid;

    /**
     * @var string | null
     *
     * @ORM\Column(name="accessToken", type="string", length=1000, nullable=true)
     * @Groups({"read","put"})
     */
    private $accesstoken;

    /**
     * @var string | null
     *
     * @ORM\Column(name="refreshToken", type="string", length=1000, nullable=true)
     * @Groups({"read","put"})
     */
    private $refreshtoken;

    /**
     * @var bool | null
     *
     * @ORM\Column(name="billable", type="boolean", nullable=true, options={"default"="1"})
     * @Groups({"read","put"})
     */
    private $billable = true;

    /**
     * @var DateTime |null
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     * @Groups({"read","put"})
     */
    private $createdat;

    /**
     * @var DateTime | null
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     * @Groups({"read","put"})
     */
    private $updatedat;


    public function __construct()
    {
        $this->updatedat = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     */
    public function setActive(?bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string | null
     */
    public function getRealmid(): ?string
    {
        return $this->realmid;
    }

    /**
     * @param string $realmid
     */
    public function setRealmid(string $realmid): void
    {
        $this->realmid = $realmid;
    }

    /**
     * @return string|null
     */
    public function getAccesstoken(): ?string
    {
        return $this->accesstoken;
    }

    /**
     * @param string|null $accesstoken
     */
    public function setAccesstoken(?string $accesstoken): void
    {
        $this->accesstoken = $accesstoken;
    }

    /**
     * @return string|null
     */
    public function getRefreshtoken(): ?string
    {
        return $this->refreshtoken;
    }

    /**
     * @param string|null $refreshtoken
     */
    public function setRefreshtoken(?string $refreshtoken): void
    {
        $this->refreshtoken = $refreshtoken;
    }

    /**
     * @return bool|null
     */
    public function getBillable(): ?bool
    {
        return $this->billable;
    }

    /**
     * @param bool|null $billable
     */
    public function setBillable(?bool $billable): void
    {
        $this->billable = $billable;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedat(): ?DateTime
    {
        return $this->createdat;
    }

    /**
     * @param DateTime|null $createdat
     */
    public function setCreatedat(?DateTime $createdat): void
    {
        $this->createdat = $createdat;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedat(): ?DateTime
    {
        return $this->updatedat;
    }

    /**
     * @param DateTime $updatedat
     */
    public function setUpdatedat(DateTime $updatedat): void
    {
        $this->updatedat = $updatedat;
    }


    //    Abstract function to be implemented for userInterface
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    //    Abstract function to be implemented for userInterface

    public function getSalt()
    {
        return null;
    }
    //    Abstract function to be implemented for userInterface

    public function eraseCredentials()
    {
    }
}

