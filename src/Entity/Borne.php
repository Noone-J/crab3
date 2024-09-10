<?php

namespace App\Entity;

use App\Repository\BorneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorneRepository::class)]
class Borne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Date de la dernière révision de la borne.
     * Représentée sous forme d'un objet DateTime.
     */
    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateDerniereRevision;

    /**
     * Indice du compteur d'unités de la borne, un entier qui représente
     * probablement le nombre d'unités consommées ou vérifiées.
     */
    #[ORM\Column(type: 'integer')]
    private int $indiceCompteurUnites;

    #[ORM\ManyToOne]
    private ?TypeBorne $leType = null;

    #[ORM\ManyToOne(inversedBy: 'lesBornes')]
    private ?Station $laStation = null;

    // Getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDerniereRevision(): ?\DateTimeInterface
    {
        return $this->dateDerniereRevision;
    }

    public function setDateDerniereRevision(\DateTimeInterface $dateDerniereRevision): static
    {
        $this->dateDerniereRevision = $dateDerniereRevision;

        return $this;
    }

    public function getLeType(): ?TypeBorne
    {
        return $this->leType;
    }

    public function setLeType(?TypeBorne $leType): static
    {
        $this->leType = $leType;

        return $this;
    }

    public function getLaStation(): ?Station
    {
        return $this->laStation;
    }

    public function setLaStation(?Station $laStation): static
    {
        $this->laStation = $laStation;

        return $this;
    }

}
