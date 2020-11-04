<?php

namespace App\Entity;

use App\Repository\AcademicYearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AcademicYearRepository::class)
 */
class AcademicYear
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
    private $year;

    /**
     * @ORM\OneToMany(targetEntity=SchoolEntryDate::class, mappedBy="academicYear")
     */
    private $schoolEntryDates;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activeForRegistration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startRegistrationDate;

    public function __construct()
    {
        $this->schoolEntryDates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|SchoolEntryDate[]
     */
    public function getSchoolEntryDates(): Collection
    {
        return $this->schoolEntryDates;
    }

    public function addSchoolEntryDate(SchoolEntryDate $schoolEntryDate): self
    {
        if (!$this->schoolEntryDates->contains($schoolEntryDate)) {
            $this->schoolEntryDates[] = $schoolEntryDate;
            $schoolEntryDate->setAcademicYear($this);
        }

        return $this;
    }

    public function removeSchoolEntryDate(SchoolEntryDate $schoolEntryDate): self
    {
        if ($this->schoolEntryDates->contains($schoolEntryDate)) {
            $this->schoolEntryDates->removeElement($schoolEntryDate);
            // set the owning side to null (unless already changed)
            if ($schoolEntryDate->getAcademicYear() === $this) {
                $schoolEntryDate->setAcademicYear(null);
            }
        }

        return $this;
    }

    public function getActiveForRegistration(): ?bool
    {
        return $this->activeForRegistration;
    }

    public function setActiveForRegistration(bool $activeForRegistration): self
    {
        $this->activeForRegistration = $activeForRegistration;

        return $this;
    }

    public function getStartRegistrationDate(): ?\DateTimeInterface
    {
        return $this->startRegistrationDate;
    }

    public function setStartRegistrationDate(\DateTimeInterface $startRegistrationDate): self
    {
        $this->startRegistrationDate = $startRegistrationDate;

        return $this;
    }
}
