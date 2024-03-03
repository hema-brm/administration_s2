<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: "product_quote")]
class ProductQuote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;


    #[ORM\ManyToOne(targetEntity: Quote::class, inversedBy: 'productQuotes')]
    #[ORM\JoinColumn(nullable: false)]
    private $quote;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $product;
    

    #[ORM\Column(nullable: false)]
    #[Assert\Positive(message: 'La quantité doit être un nombre positif.')]
    private $quantity;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $tva = null;

    #[ORM\Column(nullable: true)]
    private ?float $discount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
    public function __toString(): string
    {
        return $this->product;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getTotalHT(): float
    {
        return $this->quantity * $this->price;
    }

    public function getTotalTva(): float
    {
        return $this->getTotalHT() * ($this->tva / 100);
    }

    public function getTotalDiscount(): float
    {
        return $this->getTotalHT() * ($this->discount / 100);
    }

    public function getTotal(): float
    {
        $total = $this->getTotalHT() + $this->getTotalTva() - $this->getTotalDiscount();
        if ($total < 0) {
            $total = 0;
        }

        return $total;
    }

    public static function _getTotal($price, $quantity, $tva, $discount = 0): float
    {
        $totalHT = $price * $quantity;
        $totalTva = $totalHT * ($tva / 100);
        $totalDiscount = $totalHT * ($discount / 100);

        $total = $totalHT + $totalTva - $totalDiscount;
        if ($total < 0) {
            $total = 0;
        }

        return $total;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount;

        return $this;
    }
}
