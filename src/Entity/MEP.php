<?php

namespace App\Entity;

use App\Repository\MEPRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="meps")
 */
class MEP
{
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $fullName = null;

    #[ORM\Column(length: 100)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $politicalGroup = null;

    #[ORM\Column(length: 250)]
    private ?string $nationalPoliticalGroup = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPoliticalGroup(): ?string
    {
        return $this->politicalGroup;
    }

    public function setPoliticalGroup(string $politicalGroup): static
    {
        $this->politicalGroup = $politicalGroup;

        return $this;
    }

    public function getNationalPoliticalGroup(): ?string
    {
        return $this->nationalPoliticalGroup;
    }

    public function setNationalPoliticalGroup(string $nationalPoliticalGroup): static
    {
        $this->nationalPoliticalGroup = $nationalPoliticalGroup;

        return $this;
    }
}
