<?php

namespace App\Entity;

use App\Repository\UnidadMedidaRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UnidadMedidaRepository::class)
 * @UniqueEntity(fields={"codigo"}, message="Este código ya está en uso. Por favor, ingrese otro.")
 */
#[ORM\Entity(repositoryClass: UnidadMedidaRepository::class)]
class UnidadMedida
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5, nullable: false)]
    #[Assert\Length(
        max: 5,
        maxMessage: "El código no debe tener más de {{ limit }} caracteres."
    )]
    #[Assert\Regex(
        pattern:"/^[a-zA-Z0-9]+$/",
        message:"El código solo puede contener letras y números."
    )]
    #[Assert\NotBlank(message: "El campo Codigo no puede estar vacío.")]
    private ?string $codigo = null;

    #[ORM\Column(length: 50)]
    private ?string $unidad_medida = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getUnidadMedida(): ?string
    {
        return $this->unidad_medida;
    }

    public function setUnidadMedida(string $unidad_medida): static
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
    }
}
