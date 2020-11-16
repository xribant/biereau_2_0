<?php

namespace App\Entity;

use App\Repository\BasicPageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BasicPageRepository::class)
 * @Vich\Uploadable()
 */
class BasicPage
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
     * @ORM\OneToOne(targetEntity=NavMenu::class, inversedBy="basicPage", cascade={"persist", "remove"})
     */
    private $parentNavMenu;

    /**
     * @ORM\OneToOne(targetEntity=SubMenu::class, inversedBy="basicPage", cascade={"persist", "remove"})
     */
    private $parentSubMenu;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="parentPage", orphanRemoval=true)
     */
    private $articles;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="basic_page_banner_image", fileNameProperty="filename")
     */
    private $bannerImageFile;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->created_at = new \DateTime();
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
            $article->setParentPage($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getParentPage() === $this) {
                $article->setParentPage(null);
            }
        }

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

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return BasicPage
     */
    public function setFilename(?string $filename): BasicPage
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getBannerImageFile(): ?File
    {
        return $this->bannerImageFile;
    }

    /**
     * @param File|null $bannerImageFile
     * @return BasicPage
     */
    public function setBannerImageFile(?File $bannerImageFile): BasicPage
    {
        $this->bannerImageFile = $bannerImageFile;
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->bannerImageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }
}
