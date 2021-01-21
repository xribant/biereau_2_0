<?php

namespace App\Entity;

use App\Repository\RegistrationContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegistrationContentRepository::class)
 */
class RegistrationContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $intro;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $alert;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $alertColor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modifiedAt;

    /**
     * @ORM\OneToMany(targetEntity=RegistrationStep::class, mappedBy="RegistrationPage")
     */
    private $registrationSteps;

    public function __construct()
    {
        $this->modifiedAt = new \DateTime();
        $this->registrationSteps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(?string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getAlert(): ?string
    {
        return $this->alert;
    }

    public function setAlert(?string $alert): self
    {
        $this->alert = $alert;

        return $this;
    }

    public function getAlertColor(): ?string
    {
        return $this->alertColor;
    }

    public function setAlertColor(string $alertColor): self
    {
        $this->alertColor = $alertColor;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * @return Collection|RegistrationStep[]
     */
    public function getRegistrationSteps(): Collection
    {
        return $this->registrationSteps;
    }

    public function addRegistrationStep(RegistrationStep $registrationStep): self
    {
        if (!$this->registrationSteps->contains($registrationStep)) {
            $this->registrationSteps[] = $registrationStep;
            $registrationStep->setRegistrationPage($this);
        }

        return $this;
    }

    public function removeRegistrationStep(RegistrationStep $registrationStep): self
    {
        if ($this->registrationSteps->removeElement($registrationStep)) {
            // set the owning side to null (unless already changed)
            if ($registrationStep->getRegistrationPage() === $this) {
                $registrationStep->setRegistrationPage(null);
            }
        }

        return $this;
    }
}
