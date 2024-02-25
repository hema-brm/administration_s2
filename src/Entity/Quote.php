<?php
//Quote.php
namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote
{
    public const STATUS_DRAFT = 0;
    public const STATUS_SENT = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_REFUSED = 3;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    private int $status = 0;

    #[ORM\Column(length: 255, unique: true, nullable: false)]
    #[Assert\Unique(message: 'Ce numéro de devis est déjà utilisé.')]
    private ?string $quote_number = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $quote_issuance_date = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $expiry_date = null;

    #[ORM\Column(nullable: true)]
    private ?float $discount = 0.0;

    #[ORM\Column(nullable: true)]
    private ?float $tva = 0.0;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Valid]
    private ?Customer $customer;

    #[ORM\OneToOne(targetEntity: Bill::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Bill $bill = null;

    #[ORM\OneToMany(mappedBy: "quote", targetEntity: ProductQuote::class, cascade: ["persist", "remove"])]
    private Collection $productQuotes;

    public function __construct()
    {
        $this->productQuotes = new ArrayCollection();
    }

    public function getProductQuotes(): Collection
    {
        return $this->productQuotes;
    }

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

    public function setQuoteNumber(?string $quote_number): static
    {
        $this->quote_number = $quote_number;

        return $this;
    }

    public function getQuoteIssuanceDate(): ?\DateTimeInterface
    {
        return $this->quote_issuance_date;
    }

    public function setQuoteIssuanceDate(?\DateTimeInterface $quote_issuance_date): static
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
        // must be greater than the issuance date

        if ($expiry_date < $this->quote_issuance_date) {
            throw new \InvalidArgumentException('The expiry date must be greater than the issuance date.');
        }

        $this->expiry_date = $expiry_date;

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

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        $this->bill = $bill;
        return $this;
    }
}
