<?php

namespace App\Entity;

use App\Repository\SchoolSectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolSectionRepository::class)
 */
class SchoolSection
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
    private $sectionFullName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $sectionShortName;

    /**
     * @ORM\ManyToMany(targetEntity=Prof::class, mappedBy="section")
     */
    private $profs;

    public function __construct()
    {
        $this->profs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSectionFullName(): ?string
    {
        return $this->sectionFullName;
    }

    public function setSectionFullName(string $sectionFullName): self
    {
        $this->sectionFullName = $sectionFullName;

        return $this;
    }

    public function getSectionShortName(): ?string
    {
        return $this->sectionShortName;
    }

    public function setSectionShortName(string $sectionShortName): self
    {
        $this->sectionShortName = $sectionShortName;

        return $this;
    }

    /**
     * @return Collection|Prof[]
     */
    public function getProfs(): Collection
    {
        return $this->profs;
    }

    public function addProf(Prof $prof): self
    {
        if (!$this->profs->contains($prof)) {
            $this->profs[] = $prof;
            $prof->addSection($this);
        }

        return $this;
    }

    public function removeProf(Prof $prof): self
    {
        if ($this->profs->removeElement($prof)) {
            $prof->removeSection($this);
        }

        return $this;
    }
}
