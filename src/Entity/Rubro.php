<?php

namespace App\Entity;

use App\Repository\RubroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RubroRepository::class)]
class Rubro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $rubro = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRubro(): ?string
    {
        return $this->rubro;
    }

    public function setRubro(?string $rubro): static
    {
        $this->rubro = $rubro;

        return $this;
    }
}
