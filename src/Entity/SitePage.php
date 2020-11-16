<?php

namespace App\Entity;

use App\Repository\SitePageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SitePageRepository::class)
 */
class SitePage
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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bannerImageFile;

    /**
     * @ORM\ManyToOne(targetEntity=NavMenu::class, inversedBy="sitePages")
     */
    private $parentNavMenu;

    /**
     * @ORM\ManyToOne(targetEntity=SubMenu::class, inversedBy="sitePages")
     */
    private $parentSubMenu;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="sitePage", orphanRemoval=true)
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBannerImageFile(): ?string
    {
        return $this->bannerImageFile;
    }

    public function setBannerImageFile(string $bannerImageFile): self
    {
        $this->bannerImageFile = $bannerImageFile;

        return $this;
    }

    public function getParentNavMenu(): ?NavMenu
    {
        return $this->parentNavMenu;
    }

    public function setParentNavMenu(?NavMenu $parentNavMenu): self
    {
        $this->parentNavMenu = $parentNavMenu;

        return $this;
    }

    public function getParentSubMenu(): ?SubMenu
    {
        return $this->parentSubMenu;
    }

    public function setParentSubMenu(?SubMenu $parentSubMenu): self
    {
        $this->parentSubMenu = $parentSubMenu;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setSitePage($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSitePage() === $this) {
                $article->setSitePage(null);
            }
        }

        return $this;
    }
}
