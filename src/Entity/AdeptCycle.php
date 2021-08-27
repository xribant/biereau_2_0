<?php

namespace App\Entity;

use App\Repository\AdeptCycleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdeptCycleRepository::class)
 */
class AdeptCycle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=AdeptCycleKm::class, mappedBy="Cycle")
     */
    private $adeptCycleKms;

    public function __construct()
    {
        $this->adeptCycleKms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|AdeptCycleKm[]
     */
    public function getAdeptCycleKms(): Collection
    {
        return $this->adeptCycleKms;
    }

    public function addAdeptCycleKm(AdeptCycleKm $adeptCycleKm): self
    {
        if (!$this->adeptCycleKms->contains($adeptCycleKm)) {
            $this->adeptCycleKms[] = $adeptCycleKm;
            $adeptCycleKm->setCycle($this);
        }

        return $this;
    }

    public function removeAdeptCycleKm(AdeptCycleKm $adeptCycleKm): self
    {
        if ($this->adeptCycleKms->removeElement($adeptCycleKm)) {
            // set the owning side to null (unless already changed)
            if ($adeptCycleKm->getCycle() === $this) {
                $adeptCycleKm->setCycle(null);
            }
        }

        return $this;
    }
}
