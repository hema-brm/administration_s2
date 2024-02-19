<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'L\'adresse email est déjà utilisée par un autre compte.')]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    #[Assert\NotBlank(message: 'Veuillez saisir une adresse email.')]
    #[Assert\Email(message: 'Veuillez saisir une adresse email valide.')]
    private string $email;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Veuillez saisir un nom.')]
    #[Assert\Length(max: 50, maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $lastname = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Veuillez saisir un prénom.')]
    #[Assert\Length(max: 50, maxMessage: 'Le prénom ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255, maxMessage: 'L\'adresse ne peut pas dépasser {{ limit }} caractères.')]
    private ?string $address = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Length(max: 20, maxMessage: 'Le numéro de téléphone ne peut pas dépasser {{ limit }} caractères.')]
    #[Assert\Regex(
        pattern:"/^(\+\d{1,3}\s?)?\d{2}\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2}$/",
        message:"Le numéro de téléphone n'est pas valide."
    )]
    private ?string $phone = null;

    // Add tsvector column, used for full text search
    #[ORM\Column(type: 'tsvector', nullable: true, options: ['default' => ''])]
    private ?string $searchVector = null;

    #[ORM\ManyToOne(targetEntity: Company::class ,inversedBy: 'customers')]
    #[ORM\JoinColumn(nullable: false)]
    private Company $company;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: Quote::class, orphanRemoval: true)]
    private Collection $quote;

    public function __construct()
    {
        $this->quote = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getPhoneWithSpace(): ?string
    {
        $phone = $this->phone;
        $validPhone = '';
        if(strlen($phone) == 10){
            for($i = 0; $i<strlen($phone); $i += 2){
                $validPhone .= substr($phone, $i, 2);
                if($i != strlen($phone)-2){
                    $validPhone .= ' ';
                }
            }
        }else{
            $indSize = strlen($phone) - 10;
            $validPhone .= substr($phone, 0, $indSize).' ';
            for($i = $indSize; $i<strlen($phone); $i += 2){
                $validPhone .= substr($phone, $i, 2);
                if($i != strlen($phone)-2){
                    $validPhone .= ' ';
                }
            }
        }

        return $validPhone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSearchVector(): ?string
    {
        return $this->searchVector;
    }

    public function setSearchVector(?string $searchVector): static
    {
        $this->searchVector = $searchVector;

        return $this;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function hasCompany(): bool
    {
        return isset($this->company);
    }

    public function getQuote(): Collection
    {
        return $this->quote;
    }

    public function setQuote(Collection $quote): void
    {
        $this->quote = $quote;
    }

    public function __toString(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
