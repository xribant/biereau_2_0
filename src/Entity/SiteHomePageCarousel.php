<?php

namespace App\Entity;

use App\Repository\SiteHomePageCarouselRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SiteHomePageCarouselRepository::class)
 * @Vich\Uploadable()
 */
class SiteHomePageCarousel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @Vich\UploadableField(mapping="home_page_image", fileNameProperty="filename")
     */
    private $backgroundImageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slogan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link_to_menu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getLinkToMenu(): ?string
    {
        return $this->link_to_menu;
    }

    public function setLinkToMenu(string $link_to_menu): self
    {
        $this->link_to_menu = $link_to_menu;

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
     * @return SiteHomePageCarousel
     */
    public function setFilename(?string $filename): SiteHomePageCarousel
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getBackgroundImageFile(): ?File
    {
        return $this->backgroundImageFile;
    }

    /**
     * @param File|null $backgroundImageFile
     * @return SiteHomePageCarousel
     */
    public function setBackgroundImageFile(?File $backgroundImageFile): SiteHomePageCarousel
    {
        $this->backgroundImageFile = $backgroundImageFile;
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->backgroundImageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


}
