<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Fit>
     */
    #[ORM\OneToMany(targetEntity: Fit::class, mappedBy: 'inventory', orphanRemoval: true)]
    private Collection $Fits;

    /**
     * @var Collection<int, Set>
     */
    #[ORM\OneToMany(targetEntity: Set::class, mappedBy: 'inventory', orphanRemoval: true)]
    private Collection $Sets;

    public function __construct()
    {
        $this->Fits = new ArrayCollection();
        $this->Sets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Fit>
     */
    public function getFits(): Collection
    {
        return $this->Fits;
    }

    public function addFit(Fit $fit): static
    {
        if (!$this->Fits->contains($fit)) {
            $this->Fits->add($fit);
            $fit->setInventory($this);
        }

        return $this;
    }

    public function removeFit(Fit $fit): static
    {
        if ($this->Fits->removeElement($fit)) {
            // set the owning side to null (unless already changed)
            if ($fit->getInventory() === $this) {
                $fit->setInventory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Set>
     */
    public function getSets(): Collection
    {
        return $this->Sets;
    }

    public function addSet(Set $set): static
    {
        if (!$this->Sets->contains($set)) {
            $this->Sets->add($set);
            $set->setInventory($this);
        }

        return $this;
    }

    public function removeSet(Set $set): static
    {
        if ($this->Sets->removeElement($set)) {
            // set the owning side to null (unless already changed)
            if ($set->getInventory() === $this) {
                $set->setInventory(null);
            }
        }

        return $this;
    }
}
