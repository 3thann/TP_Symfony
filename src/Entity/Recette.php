<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredients = null;

    #[ORM\Column(length: 255)]
    private ?string $ustencils = null;

    #[ORM\Column(length: 255)]
    private ?string $instructions = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $temps_cuisson = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): static
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getUstencils(): ?string
    {
        return $this->ustencils;
    }

    public function setUstencils(string $ustencils): static
    {
        $this->ustencils = $ustencils;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getTempsCuisson(): ?string
    {
        return $this->temps_cuisson;
    }

    public function setTempsCuisson(string $temps_cuisson): static
    {
        $this->temps_cuisson = $temps_cuisson;

        return $this;
    }
}
