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
     * @ORM\OneToMany(targetEntity=SubMenu::class, mappedBy="parentNavMenu")
     */
    private $subMenus;

    /**
     * @ORM\OneToOne(targetEntity=BasicPage::class, mappedBy="parentNavMenu", cascade={"persist", "remove"})
     */
    private $basicPage;

    public function __construct()
    {
        $this->subMenus = new ArrayCollection();
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

    public function getBasicPage(): ?BasicPage
    {
        return $this->basicPage;
    }

    public function setBasicPage(?BasicPage $basicPage): self
    {
        $this->basicPage = $basicPage;

        // set (or unset) the owning side of the relation if necessary
        $newParentMenu = null === $basicPage ? null : $this;
        if ($basicPage->getParentMenu() !== $newParentMenu) {
            $basicPage->setParentMenu($newParentMenu);
        }

        return $this;
    }
}
