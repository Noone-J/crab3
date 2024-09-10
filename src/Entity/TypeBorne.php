<?php

namespace App\Entity;

use App\Repository\TypeBorneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeBorneRepository::class)]
class TypeBorne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Durée typique pour réviser une borne de ce type.
     * Représenté sous forme d'entier (par exemple, nombre de minutes).
     */
    #[ORM\Column(type: 'integer')]
    private int $dureeRevision;

    /**
     * Nombre de jours entre deux révisions consécutives de ce type de borne.
     */
    #[ORM\Column(type: 'integer')]
    private int $nbJoursEntreRevisions;

    /**
     * Nombre d'unités avant qu'une révision soit nécessaire.
     */
    #[ORM\Column(type: 'integer')]
    private int $nbUnitesEntreRevisions;

    // Getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDureeRevision(): ?int
    {
        return $this->dureeRevision;
    }

    public function setDureeRevision(int $dureeRevision): static
    {
        $this->dureeRevision = $dureeRevision;

        return $this;
    }

    public function getNbJoursEntreRevisions(): ?int
    {
        return $this->nbJoursEntreRevisions;
    }

    public function setNbJoursEntreRevisions(int $nbJoursEntreRevisions): static
    {
        $this->nbJoursEntreRevisions = $nbJoursEntreRevisions;

        return $this;
    }

    public function getNbUnitesEntreRevisions(): ?int
    {
        return $this->nbUnitesEntreRevisions;
    }

    public function setNbUnitesEntreRevisions(int $nbUnitesEntreRevisions): static
    {
        $this->nbUnitesEntreRevisions = $nbUnitesEntreRevisions;

        return $this;
    }
}
