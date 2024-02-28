<?php
// src/Entity/Bill.php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Customer $customer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $billNumber;

    #[ORM\ManyToOne(targetEntity: Quote::class)]
    #[ORM\JoinColumn(name: "quote_id", referencedColumnName: "id", nullable: true)]
    private ?Quote $quote;

    #[ORM\Column(nullable: true)]
    private ?float $discount = null;

    #[ORM\Column(nullable: true)]
    private ?float $tva = null;

    #[ORM\Column(length: 255)]
    private ?int $status = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $billIssuanceDate = null;

    #[ORM\OneToMany(mappedBy: "bill", targetEntity: ProductBill::class, cascade: ["persist", "remove"])]
    private Collection $productBills;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getBillIssuanceDate(): ?\DateTimeInterface
    {
        return $this->billIssuanceDate;
    }

    public function setBillIssuanceDate(\DateTimeInterface $billIssuanceDate): static
    {
        $this->billIssuanceDate = $billIssuanceDate;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): static
    {
        $this->discount = $discount;

        return $this;
    }
    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTVA(float $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function __construct()
    {
        $this->productBills = new ArrayCollection();
    }


    public function getProductBills(): Collection
    {
        return $this->productBills;
    }

    /**
     * @param ProductBill $productBill
     * @return $this
     */
    public function addProductBill(ProductBill $productBill): self
    {
        if (!$this->productBills->contains($productBill)) {
            $this->productBills[] = $productBill;
            $productBill->setBill($this);
        }

        return $this;
    }

    public function removeProductBill(ProductBill $productBill): self
    {
        if ($this->productBills->removeElement($productBill)) {
            // set the owning side to null (unless already changed)
            if ($productBill->getBill() === $this) {
                $productBill->setBill(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
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

    public function getBillNumber(): ?string
    {
        return $this->billNumber;
    }

    public function setBillNumber(?string $billNumber): self
    {
        $this->billNumber = $billNumber;
        return $this;
    }

}
