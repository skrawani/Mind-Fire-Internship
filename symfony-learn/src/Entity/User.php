<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *      itemOperations={
 *          "read"={
 *              "method"="GET",
 *              "security"="is_granted('IS_AUTHENTICATED_FULLY')",
 *              "normalization_context"={
 *                   "groups"={"read"}
 *              }
 *          },
 *          "put"={
 *              "method"="PUT",
 *              "security"="is_granted('IS_AUTHENTICATED_FULLY') and object === user",
 *               "denormalization_context"={
 *                   "groups"={"put"}
 *              }
 *          }
 *      },
 *     collectionOperations={
 *          "post"={
 *              "method"="POST",
 *              "denormalization_context"={
 *                   "groups"={"post"}
 *              }
 *           }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository", repositoryClass=UserRepository::class)
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "post"})
     * @Assert\NotBlank()
     * @Assert\Length(min= 6, max=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({ "post","put"})
     * @Assert\NotBlank()
     * @Assert\Regex(
     *      pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
     *     message="Password must be 7 charcters long at least 1 digit,
     *      1 upperCase charcter , 1 LowerCase character"
     * )
     */
    private $password;

//    /**
//     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="password")
//     * @Groups ({"GET", "write"})
//     * @Assert\NotBlank()
//     */
//    private $retypePassword;



    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "post", "put"})
     * @Assert\NotBlank()
     * @Assert\Length(min= 3, max=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "post", "put"})
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Length(min= 6, max=255)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BlogPost", mappedBy="author")
     *  @Groups ({"read"})
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="author")
     *  @Groups ({"read"})
     */
    private $comments;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();

    }

    public function GETId(): ?int
    {
        return $this->id;
    }

    public function GETUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function GETPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function GETName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection
     */
    public function GETPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * @return Collection
     */
    public function GETComments(): Collection
    {
        return $this->comments;
    }


    public function GETRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function GETSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

//FIXME: retypePassword(virtual field) not working
//    public function GETRetypePassword()
//    {
//        return $this->retypePassword;
//    }
//
//
//    public function setRetypePassword($retypePassword): void
//    {
//        $this->retypePassword = $retypePassword;
//    }





}
