<?php
//ProductBill.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "product_bill")]
class ProductBill
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;


    #[ORM\ManyToOne(targetEntity: Bill::class, inversedBy: 'productBill')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bill $bill;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    #[ORM\Column(nullable: true)]
    private int $quantity = 1;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'float')]
    private ?float $tva = 0.0;

    #[ORM\Column(nullable: true)]
    private ?float $discount = 0.0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        $this->bill = $bill;

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

    public function setQuantity(?int $quantity = null): self
    {
        if (empty($quantity)) {
            $quantity = 1;
        }
        $this->quantity = $quantity;

        return $this;
    }
    public function __toString(): string
    {
        return $this->product;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getTotalHT(): float
    {
        return $this->quantity * $this->price;
    }

    public function getTotalTVA(): float
    {
        return $this->getTotalHT() * ($this->tva / 100);
    }

    public function getTotalTTC(): float
    {
        return $this->getTotalHT() + $this->getTotalTVA();
    }

    public function getTotalDiscount(): float
    {
        return $this->getTotalHT() * ($this->discount / 100);
    }

    public function getTotal(): float
    {
        return $this->getTotalTTC() - $this->getTotalDiscount();
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(?float $tva = null): static
    {
        if ($tva === null) {
            $tva = Product::DEFAULT_TAX_RATE;
        }
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

    public function hasId(): bool
    {
        return !empty($this->id);
    }
}
