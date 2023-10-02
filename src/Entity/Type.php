<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Vehicul::class)]
    private Collection $vehiculs;

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
            $vehicul->setType($this);
        }

        return $this;
    }

    public function removeVehicul(Vehicul $vehicul): static
    {
        if ($this->vehiculs->removeElement($vehicul)) {
            // set the owning side to null (unless already changed)
            if ($vehicul->getType() === $this) {
                $vehicul->setType(null);
            }
        }

        return $this;
    }
}
