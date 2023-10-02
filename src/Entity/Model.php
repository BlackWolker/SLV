<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: Vehicul::class)]
    private Collection $vehiculs;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand = null;

    public function __construct()
    {
        $this->vehiculs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Vehicul>
     */
    public function getVehiculs(): Collection
    {
        return $this->vehiculs;
    }

    public function addVehicul(Vehicul $vehicul): static
    {
        if (!$this->vehiculs->contains($vehicul)) {
            $this->vehiculs->add($vehicul);
            $vehicul->setModel($this);
        }

        return $this;
    }

    public function removeVehicul(Vehicul $vehicul): static
    {
        if ($this->vehiculs->removeElement($vehicul)) {
            // set the owning side to null (unless already changed)
            if ($vehicul->getModel() === $this) {
                $vehicul->setModel(null);
            }
        }

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }
}
