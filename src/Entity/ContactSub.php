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
    const ENTRYDATE = [ // Créer une entité à modifier dans une partie Admin
        '' => '',
        1 => '1er Septembre 2021',
        2 => '8 Novembre 2021',
        3 => '10 Janvier 2022',
        4 => '7 Février 2022'
    ];

    const REGSESSION = [ // Créer une entité à modifier dans une partie Admin
        0 => '',
        1 => '24 Novembre 2021',
        2 => '31 Mars 2021'
    ];

    const SECTION = [ // Créer une entité à modifier dans une partie Admin
        '' => 'Section',
        'A' => 'Accueil',
        'M1' => '1ère Maternelle',
        'M2' => '2e Maternelle',
        'M3' => '3e Maternelle',
        'P1' => '1ère Primaire',
        'P2' => '2e Primaire',
        'P3' => '3e Primaire',
        'P4' => '4e Primaire',
        'P5' => '5e Primaire',
        'P6' => '6e Primaire'
    ];

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
     *     pattern="/[0-9],{9-10}"
     * )
     */
    private $parentPhone;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
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
}
