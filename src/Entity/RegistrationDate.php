<?php

namespace App\Entity;

use App\Repository\RegistrationDateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegistrationDateRepository::class)
 */
class RegistrationDate
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
    private $regDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegDate(): ?\DateTimeInterface
    {
        return $this->regDate;
    }

    public function setRegDate(\DateTimeInterface $regDate): self
    {
        $this->regDate = $regDate;

        return $this;
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
