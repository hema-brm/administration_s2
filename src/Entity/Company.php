<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $siretNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: User::class)]
    private Collection $UserId;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Category::class,cascade: ["persist"],orphanRemoval: true)]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Customer::class)]
    private Collection $customers;

    public function __construct()
    {
        $this->UserId = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->products = new ArrayCollection();

        $this->addCategory(new Category("Décoration"));
        $this->addCategory(new Category("Traiteur"));
        $this->addCategory(new Category("Divertissement"));
        $this->customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSiretNumber(): ?string
    {
        return $this->siretNumber;
    }

    public function setSiretNumber(?string $siretNumber): static
    {
        $this->siretNumber = $siretNumber;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->UserId;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->UserId->contains($userId)) {
            $this->UserId->add($userId);
            $userId->setCompany($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        if ($this->UserId->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getCompany() === $this) {
                $userId->setCompany(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setCompanyId($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getCompanyId() === $this) {
                $category->setCompanyId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCompanyId($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCompanyId() === $this) {
                $product->setCompanyId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): static
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->setCompany($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): static
    {
        if ($this->customers->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getCompany() === $this) {
                $customer->setCompany(null);
            }
        }

        return $this;
    }

}
