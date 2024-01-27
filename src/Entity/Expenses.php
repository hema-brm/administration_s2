<?php

namespace App\Entity;

use App\Repository\ExpensesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpensesRepository::class)]
class Expenses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Product $product = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\Column(length: 255,nullable: true)]
    private ?string $total = null;

    public function __construct()
    {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?string
    {
        if ($this->product !== null) {
            return $this->product->getPrice();
        }
        
        return null;
    }

    public function setPrice(?string $price): self
    {
        // Here, we don't set the price directly in Expenses, as it's retrieved from the associated Product
        return $this;
    }

    public function getCategory(): ?string
    {
        if ($this->product !== null) {
            return $this->product->getCategory()->getName();
        }
        
        return null;
    }

    public function setCategory(?string $category): self
    {
        // Here, we don't set the category directly in Expenses, as it's retrieved from the associated Product
        return $this;
    }

    public function getTotal(): ?string
    {
        if ($this->quantity !== null && $this->price !== null) {
            return (string)($this->quantity * floatval($this->price));
        }

        return null;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        // Mettre à jour le total en fonction de la quantité et du prix
        $quantity = $this->getQuantity();
        $price = $this->getPrice();

        if ($quantity !== null && $price !== null) {
            $this->total = $quantity * $price;
        }

        return $this;
    }


    public function __toString(): string
    {
        return $this->product ? $this->product->getName() : 'Aucun produit associé';
    }
}
