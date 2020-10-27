<?php

namespace App\Entity;

use App\Repository\SchoolEntryDateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchoolEntryDateRepository::class)
 */
class SchoolEntryDate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $entryDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->entryDate;
    }

    public function setEntryDate(\DateTimeInterface $entryDate): self
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->textDate;
    }

    public function getTextDate(): ?string
    {
        return $this->textDate;
    }

    public function setTextDate(string $textDate): self
    {
        $this->textDate = $textDate;

        return $this;
    }
}
