<?php

namespace App\Entity;

use App\Repository\ProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfRepository::class)
 */
class Prof
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Member::class, inversedBy="prof", cascade={"persist", "remove"})
     */
    private $member;

    /**
     * @ORM\ManyToMany(targetEntity=SchoolSection::class, inversedBy="profs")
     */
    private $section;

    public function __construct()
    {
        $this->section = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    /**
     * @return Collection|SchoolSection[]
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(SchoolSection $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
        }

        return $this;
    }

    public function removeSection(SchoolSection $section): self
    {
        $this->section->removeElement($section);

        return $this;
    }
}
