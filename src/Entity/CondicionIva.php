<?php

namespace App\Entity;

use App\Repository\CondicionIvaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UnidadMedidaRepository::class)
 * @UniqueEntity(fields={"codigo"}, message="Este código ya está en uso. Por favor, ingrese otro.")
 */
#[ORM\Entity(repositoryClass: CondicionIvaRepository::class)]
class CondicionIva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Regex(
        pattern:"/^[a-zA-Z0-9]+$/",
        message:"El código solo puede contener letras y números."
    )]
    #[Assert\NotBlank(message: "El campo Codigo no puede estar vacío.")]
    private ?int $codigo = null;

    #[ORM\Column(length: 50)]
    private ?string $condicion_iva = null;

    #[ORM\Column(nullable: true)]
    private ?float $alicuota = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getCondicionIva(): ?string
    {
        return $this->condicion_iva;
    }

    public function setCondicionIva(string $condicion_iva): static
    {
        $this->condicion_iva = $condicion_iva;

        return $this;
    }

    public function getAlicuota(): ?float
    {
        return $this->alicuota;
    }

    public function setAlicuota(?float $alicuota): static
    {
        $this->alicuota = $alicuota;

        return $this;
    }
}
