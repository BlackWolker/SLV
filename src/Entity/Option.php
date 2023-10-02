<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Vehicul::class, inversedBy: 'options')]
    private Collection $vehicul;

    public function __construct()
    {
        $this->vehicul = new ArrayCollection();
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
    public function getVehicul(): Collection
    {
        return $this->vehicul;
    }

    public function addVehicul(Vehicul $vehicul): static
    {
        if (!$this->vehicul->contains($vehicul)) {
            $this->vehicul->add($vehicul);
        }

        return $this;
    }

    public function removeVehicul(Vehicul $vehicul): static
    {
        $this->vehicul->removeElement($vehicul);

        return $this;
    }
}
