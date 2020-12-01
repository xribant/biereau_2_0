<?php

namespace App\Entity;

use App\Repository\NavMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NavMenuRepository::class)
 */
class NavMenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $route;

    /**
     * @ORM\Column(type="boolean")
     */
    private $externalLink;

    /**
     * @ORM\OneToMany(targetEntity=SubMenu::class, mappedBy="parentMenu")
     */
    private $subMenus;

    /**
     * @ORM\OneToMany(targetEntity=BasicPage::class, mappedBy="parentNavMenu")
     */
    private $basicPages;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $position;

    public function __construct()
    {
        $this->subMenus = new ArrayCollection();
        $this->basicPages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(?string $route): self
    {
        $this->route = $route;

        return $this;
    }

    public function getExternalLink(): ?bool
    {
        return $this->externalLink;
    }

    public function setExternalLink(bool $externalLink): self
    {
        $this->externalLink = $externalLink;

        return $this;
    }

    /**
     * @return Collection|SubMenu[]
     */
    public function getSubMenus(): Collection
    {
        return $this->subMenus;
    }

    public function addSubMenu(SubMenu $subMenu): self
    {
        if (!$this->subMenus->contains($subMenu)) {
            $this->subMenus[] = $subMenu;
            $subMenu->setParentMenu($this);
        }

        return $this;
    }

    public function removeSubMenu(SubMenu $subMenu): self
    {
        if ($this->subMenus->removeElement($subMenu)) {
            // set the owning side to null (unless already changed)
            if ($subMenu->getParentMenu() === $this) {
                $subMenu->setParentMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BasicPage[]
     */
    public function getBasicPages(): Collection
    {
        return $this->basicPages;
    }

    public function addBasicPage(BasicPage $basicPage): self
    {
        if (!$this->basicPages->contains($basicPage)) {
            $this->basicPages[] = $basicPage;
            $basicPage->setParentNavMenu($this);
        }

        return $this;
    }

    public function removeBasicPage(BasicPage $basicPage): self
    {
        if ($this->basicPages->removeElement($basicPage)) {
            // set the owning side to null (unless already changed)
            if ($basicPage->getParentNavMenu() === $this) {
                $basicPage->setParentNavMenu(null);
            }
        }

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }
}
