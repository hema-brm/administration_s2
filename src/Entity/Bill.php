<?php
// src/Entity/Bill.php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $CreationDate = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $totalPrice;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $numeroFacture;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $entreprise;

    #[ORM\ManyToOne(targetEntity: Quote::class)]
    #[ORM\JoinColumn(name: "quote_id", referencedColumnName: "id", nullable: true)]
    private ?Quote $quote;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quote_number = null;

    #[ORM\Column(nullable: true)]
    private ?float $discount = null;

    #[ORM\Column(nullable: true)]
    private ?float $tva = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $billIssuanceDate = null;

    #[ORM\OneToMany(mappedBy: "bill", targetEntity: ProductBill::class, cascade: ["persist", "remove"])]
    private Collection $productBills;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->CreationDate;
    }

    public function setCreationDate(\DateTimeInterface $date): static
    {
        $this->CreationDate = $date;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
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
        $this->quote_number = $quote ? $quote->getId() : null; // Utilisez getId() ou une autre méthode pour obtenir l'ID de la citation
        return $this;
    }

    public function getQuoteNumber(): ?string
    {
        return $this->quote_number;
    }

    public function setQuoteNumber(?string $quote_number): self
    {
        $this->quote_number = $quote_number;
        return $this;
    }

    public function getTotalPrice(): ?string
    {
        // Initialiser le total à 0
        $total = 0;

        // Parcourir tous les ProductBills associés à cette facture
        foreach ($this->getProductBills() as $productBill) {
            // Ajouter le total de chaque produit au total général
            $total += $productBill->getTotal();
        }

        // Retourner le total sous forme de chaîne de caractères
        return strval($total);
    }

    public function setTotalPrice(?string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    public function setNumeroFacture(?string $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;
        return $this;
    }

    public function getEntreprise(): ?Company
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Company $entreprise): self
    {
        $this->entreprise = $entreprise;
        return $this;
    }
}
