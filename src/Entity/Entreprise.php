<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

     /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $Numero_Siret;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Adresse = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: User::class)]
    private Collection $UserId;

    public function __construct()
    {
        $this->UserId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumeroSiret(): ?int
    {
        return $this->Numero_Siret;
    }

    public function setNumeroSiret(int $Numero_Siret): static
    {
        $this->Numero_Siret = $Numero_Siret;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(?string $Adresse): static
    {
        $this->Adresse = $Adresse;

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
            $userId->setEntreprise($this);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        if ($this->UserId->removeElement($userId)) {
            // set the owning side to null (unless already changed)
            if ($userId->getEntreprise() === $this) {
                $userId->setEntreprise(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }

}
