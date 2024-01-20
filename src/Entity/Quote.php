<?php
//Quote.php
namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'tsvector', nullable: true, options: ['default' => ''])]
    private ?string $searchVector = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $quote_number = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $quote_issuance_date = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $expiry_date = null;

    #[ORM\Column]
    private ?float $total_price = null;

    #[ORM\Column(nullable: true)]
    private ?float $discount = null;

    #[ORM\Column(nullable: true)]
    private ?float $tva = null;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    

    #[ORM\OneToMany(targetEntity: ProductQuote::class, mappedBy: "quote", cascade: ["persist", "remove"])]
    private Collection $productQuotes;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Company $company = null;

    public function getSearchVector(): ?string
    {
        return $this->searchVector;
    }

    public function setSearchVector(?string $searchVector): static
    {
        $this->searchVector = $searchVector;

        return $this;
    }
    
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
    
    public function __construct()
    {
        $this->productQuotes = new ArrayCollection();
    }


    public function getProductQuotes(): Collection
    {
        return $this->productQuotes;
    }

    /**
     * @param ProductQuote $productQuote
     * @return $this
     */
    public function addProductQuote(ProductQuote $productQuote): self
    {
        if (!$this->productQuotes->contains($productQuote)) {
            $this->productQuotes[] = $productQuote;
            $productQuote->setQuote($this);
        }

        return $this;
    }

    public function removeProductQuote(ProductQuote $productQuote): self
    {
        if ($this->productQuotes->removeElement($productQuote)) {
            // set the owning side to null (unless already changed)
            if ($productQuote->getQuote() === $this) {
                $productQuote->setQuote(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getQuoteNumber(): ?string
    {
        return $this->quote_number;
    }

    public function setQuoteNumber(string $quote_number): static
    {
        $this->quote_number = $quote_number;

        return $this;
    }

    public function getQuoteIssuanceDate(): ?\DateTimeInterface
    {
        return $this->quote_issuance_date;
    }

    public function setQuoteIssuanceDate(\DateTimeInterface $quote_issuance_date): static
    {
        $this->quote_issuance_date = $quote_issuance_date;

        return $this;
    }

    public function getExpiryDate(): ?\DateTimeInterface
    {
        return $this->expiry_date;
    }

    public function setExpiryDate(?\DateTimeInterface $expiry_date): static
    {
        $this->expiry_date = $expiry_date;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(float $total_price): static
    {
        $this->total_price = $total_price;

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
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;
        return $this;
    }
}
