<?php

namespace App\Entity;

use App\Repository\SubMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubMenuRepository::class)
 */
class SubMenu
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
     * @ORM\ManyToOne(targetEntity=NavMenu::class, inversedBy="subMenus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentMenu;

    /**
     * @ORM\OneToMany(targetEntity=News::class, mappedBy="internalRoute")
     */
    private $news;

    /**
     * @ORM\OneToOne(targetEntity=BasicPage::class, mappedBy="parentSubMenu", cascade={"persist", "remove"})
     */
    private $basicPage;

    public function __construct()
    {
        $this->news = new ArrayCollection();
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

    public function getParentMenu(): ?NavMenu
    {
        return $this->parentMenu;
    }

    public function setParentMenu(?NavMenu $parentMenu): self
    {
        $this->parentMenu = $parentMenu;

        return $this;
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->setInternalRoute($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->removeElement($news)) {
            // set the owning side to null (unless already changed)
            if ($news->getInternalRoute() === $this) {
                $news->setInternalRoute(null);
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
        $newParentSubMenu = null === $basicPage ? null : $this;
        if ($basicPage->getParentSubMenu() !== $newParentSubMenu) {
            $basicPage->setParentSubMenu($newParentSubMenu);
        }

        return $this;
    }
}
