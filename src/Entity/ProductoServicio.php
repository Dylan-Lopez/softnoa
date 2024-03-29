<?php

namespace App\Entity;

use App\Repository\ProductoServicioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductoServicioRepository::class)
 * @UniqueEntity(fields={"codigo"}, message="Este código ya está en uso. Por favor, ingrese otro.")
 */
#[ORM\Entity(repositoryClass: ProductoServicioRepository::class)]
class ProductoServicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Rubro::class)]
    #[ORM\JoinColumn(name: 'id_rubro', referencedColumnName: 'id', onDelete:'SET NULL')]
    private ?Rubro $idRubro = null;

    #[ORM\Column(length: 1)]
    private ?string $tipo = null;

    #[ORM\ManyToOne(targetEntity: UnidadMedida::class)]
    #[ORM\JoinColumn(name: 'id_unidad_medida', referencedColumnName: 'id', onDelete:'SET NULL')]
    private ?UnidadMedida $idUnidadMedida = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Assert\Regex(
        pattern:"/^[a-zA-Z0-9]+$/",
        message:"El código solo puede contener letras y números."
    )]
    #[Assert\NotBlank(message: "El campo Codigo no puede estar vacío.")]
    private ?string $codigo = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "El campo Producto / Servicio no puede estar vacío.")]
    private ?string $productoServicio = null;

    #[ORM\ManyToOne(targetEntity: CondicionIva::class)]
    #[ORM\JoinColumn(name: 'id_condicion_iva', referencedColumnName: 'id', onDelete:'SET NULL')]
    private ?CondicionIva $idCondicionIva = null;

    #[ORM\Column]
    private ?float $precioBrutoUnitario = null;

    #[ORM\Column(type: "date", options: ["default" => "CURRENT_DATE"])]
    private ?\DateTimeInterface $fecha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdRubro(): ?Rubro
    {
        return $this->idRubro;
    }

    public function setIdRubro(?Rubro $idRubro): static
    {
        $this->idRubro = $idRubro;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getIdUnidadMedida(): ?UnidadMedida
    {
        return $this->idUnidadMedida;
    }

    public function setIdUnidadMedida(?UnidadMedida $idUnidadMedida): static
    {
        $this->idUnidadMedida = $idUnidadMedida;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getProductoServicio(): ?string
    {
        return $this->productoServicio;
    }

    public function setProductoServicio(string $productoServicio): static
    {
        $this->productoServicio = $productoServicio;

        return $this;
    }

    public function getIdCondicionIva(): ?CondicionIva
    {
        return $this->idCondicionIva;
    }

    public function setIdCondicionIva(?CondicionIva $idCondicionIva): static
    {
        $this->idCondicionIva = $idCondicionIva;

        return $this;
    }

    public function getPrecioBrutoUnitario(): ?float
    {
        return $this->precioBrutoUnitario;
    }

    public function setPrecioBrutoUnitario(float $precioBrutoUnitario): static
    {
        $this->precioBrutoUnitario = $precioBrutoUnitario;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
    public function __construct()
    {
        $this->fecha = new \DateTime();
    }
}
