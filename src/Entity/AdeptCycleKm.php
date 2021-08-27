<?php

namespace App\Entity;

use App\Repository\AdeptCycleKmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdeptCycleKmRepository::class)
 */
class AdeptCycleKm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\ManyToOne(targetEntity=AdeptCycle::class, inversedBy="adeptCycleKms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Cycle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $walked_at;

    public function __construct()
    {
        $this->added_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getCycle(): ?AdeptCycle
    {
        return $this->Cycle;
    }

    public function setCycle(?AdeptCycle $Cycle): self
    {
        $this->Cycle = $Cycle;

        return $this;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->added_at;
    }

    public function setAddedAt(\DateTimeInterface $added_at): self
    {
        $this->added_at = $added_at;

        return $this;
    }

    public function getWalkedAt(): ?\DateTimeInterface
    {
        return $this->walked_at;
    }

    public function setWalkedAt(?\DateTimeInterface $walked_at): self
    {
        $this->walked_at = $walked_at;

        return $this;
    }
}
