<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $account;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @ORM\Column(type="string")
     */
    private $bodytype;

    /**
     * @ORM\Column(type="string")
     */
    private $ethnicity;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     */
    private $employment;

    /**
     * @ORM\Column(type="string")
     */
    private $sexuality;

    /**
     * @ORM\Column(type="string")
     */
    private $prefer;

    /**
     * @ORM\Column(type="string")
     */
    private $purpose;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $balance;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $vip;


    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(string $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getBodytype(): ?string
    {
        return $this->bodytype;
    }

    public function setBodytype(string $bodytype): self
    {
        $this->bodytype = $bodytype;

        return $this;
    }

    public function getEthnicity(): ?string
    {
        return $this->ethnicity;
    }

    public function setEthnicity(string $ethnicity): self
    {
        $this->ethnicity = $ethnicity;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmployment(): ?string
    {
        return $this->employment;
    }

    public function setEmployment(string $employment): self
    {
        $this->employment = $employment;

        return $this;
    }

    public function getSexuality(): ?string
    {
        return $this->sexuality;
    }

    public function setSexuality(string $sexuality): self
    {
        $this->sexuality = $sexuality;

        return $this;
    }

    public function getPrefer(): ?string
    {
        return $this->prefer;
    }

    public function setPrefer(string $prefer): self
    {
        $this->prefer = $prefer;

        return $this;
    }

    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    public function setPurpose(string $purpose): self
    {
        $this->purpose = $purpose;

        return $this;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getVip(): ?string
    {
        return $this->vip;
    }

    public function setVip(string $vip): self
    {
        $this->vip = $vip;

        return $this;
    }
}
