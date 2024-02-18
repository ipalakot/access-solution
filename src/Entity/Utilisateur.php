<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[UniqueEntity('email')]
#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: 'this field is not empty')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    )]

    private ?string $fullName = null;


    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Assert\Email()]
    #[Assert\Length(
        min: 2,
        max: 180,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    )]
    private ?string $email = null;


    private ?string $plainPassword = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank()]

    private string $password = 'password';

    #[ORM\Column(type: 'string', length: 100)]        #[Assert\NotBlank(message: 'this field is not empty')]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    )]
    private ?string $deliveryAddress = null;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\NotBlank(message: 'this field is not empty')]
    #[Assert\Length(
        min: 2,
        max: 10,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    )]

    private ?string $zipCode = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: 'this field is not empty')]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    )]

    private ?string $city = null;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    #[Assert\NotBlank(message: 'this field is not empty')]
    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    )]

    private ?string $phoneNumber = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(string $deliveryAddress): static
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
