<?php

namespace App\Entity;

use App\Repository\PreRegistrationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PreRegistrationRepository::class)
 */
class PreRegistration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $parentFirstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $parentLastName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[0-9]{9,10}"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $childFirstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $childLastName;

    /**
     * @ORM\Column(type="date")
     * @Assert\DateTime()
     */
    private $childBirthDate;

    /**
     * @ORM\Column(type="date")
     * @Assert\DateTime()
     */
    private $childEntryDate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $childSection;

    /**
     * @ORM\Column(type="date")
     * @Assert\DateTime()
     */
    private $registrationSession;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentFirstName(): ?string
    {
        return $this->parentFirstName;
    }

    public function setParentFirstName(string $parentFirstName): self
    {
        $this->parentFirstName = $parentFirstName;

        return $this;
    }

    public function getParentLastName(): ?string
    {
        return $this->parentLastName;
    }

    public function setParentLastName(string $parentLastName): self
    {
        $this->parentLastName = $parentLastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getChildFirstName(): ?string
    {
        return $this->childFirstName;
    }

    public function setChildFirstName(string $childFirstName): self
    {
        $this->childFirstName = $childFirstName;

        return $this;
    }

    public function getChildLastName(): ?string
    {
        return $this->childLastName;
    }

    public function setChildLastName(string $childLastName): self
    {
        $this->childLastName = $childLastName;

        return $this;
    }

    public function getChildBirthDate(): ?\DateTimeInterface
    {
        return $this->childBirthDate;
    }

    public function setChildBirthDate(\DateTimeInterface $childBirthDate): self
    {
        $this->childBirthDate = $childBirthDate;

        return $this;
    }

    public function getChildEntryDate(): ?\DateTimeInterface
    {
        return $this->childEntryDate;
    }

    public function setChildEntryDate(\DateTimeInterface $childEntryDate): self
    {
        $this->childEntryDate = $childEntryDate;

        return $this;
    }

    public function getChildSection(): ?string
    {
        return $this->childSection;
    }

    public function setChildSection(string $childSection): self
    {
        $this->childSection = $childSection;

        return $this;
    }

    public function getRegistrationSession(): ?\DateTimeInterface
    {
        return $this->registrationSession;
    }

    public function setRegistrationSession(\DateTimeInterface $registrationSession): self
    {
        $this->registrationSession = $registrationSession;

        return $this;
    }
}
