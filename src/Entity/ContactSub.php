<?php

namespace App\Entity;

use App\Repository\ContactSubRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactSubRepository::class)
 */
class ContactSub
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
     * @Assert\Regex(
     *     pattern="/[0-9]{9,10}/"
     * )
     */
    private $parentPhone;

    /**
     * @ORM\Column(type="string", length=100)
     *@Assert\Email()
     */
    private $parentEmail;

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
     * @Assert\NotBlank()
     */
    private $childBirthDate;

    /**
     * @ORM\Column(type="date")
     */
    private $childEntryDate;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $childSection;

    /**
     * @ORM\Column(type="date")
     */
    private $sessionDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

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

    public function getParentPhone(): ?string
    {
        return $this->parentPhone;
    }

    public function setParentPhone(string $parentPhone): self
    {
        $this->parentPhone = $parentPhone;

        return $this;
    }

    public function getParentEmail(): ?string
    {
        return $this->parentEmail;
    }

    public function setParentEmail(string $parentEmail): self
    {
        $this->parentEmail = $parentEmail;

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

    public function getSessionDate(): ?\DateTimeInterface
    {
        return $this->sessionDate;
    }

    public function setSessionDate(\DateTimeInterface $sessionDate): self
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->childEntryDate;
    }
}
