<?php

namespace App\Entity;

use App\Repository\SchoolSectionRepository;
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
}
