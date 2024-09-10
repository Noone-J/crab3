<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

 /**
     * Libellé de l'emplacement de la station, une chaîne de caractères.
     * Cela pourrait représenter un nom ou une adresse.
     */
    #[ORM\Column(type: 'string', length: 100)]
    private string $libelleEmplacement;

    /**
     * @var Collection<int, Borne>
     */
    #[ORM\OneToMany(targetEntity: Borne::class, mappedBy: 'laStation')]
    private Collection $lesBornes;

    #[ORM\ManyToOne(inversedBy: 'lesStations')]
    private ?Maintenance $laMaintenance = null;

    public function __construct()
    {
        $this->lesBornes = new ArrayCollection();
    }

    // Getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleEmplacement(): ?string
    {
        return $this->libelleEmplacement;
    }

    public function setLibelleEmplacement(string $libelleEmplacement): static
    {
        $this->libelleEmplacement = $libelleEmplacement;

        return $this;
    }

    /**
     * @return Collection<int, Borne>
     */
    public function getLesBornes(): Collection
    {
        return $this->lesBornes;
    }

    public function addLesBorne(Borne $lesBorne): static
    {
        if (!$this->lesBornes->contains($lesBorne)) {
            $this->lesBornes->add($lesBorne);
            $lesBorne->setLaStation($this);
        }

        return $this;
    }

    public function removeLesBorne(Borne $lesBorne): static
    {
        if ($this->lesBornes->removeElement($lesBorne)) {
            // set the owning side to null (unless already changed)
            if ($lesBorne->getLaStation() === $this) {
                $lesBorne->setLaStation(null);
            }
        }

        return $this;
    }

    public function getLaMaintenance(): ?Maintenance
    {
        return $this->laMaintenance;
    }

    public function setLaMaintenance(?Maintenance $laMaintenance): static
    {
        $this->laMaintenance = $laMaintenance;

        return $this;
    }
}
