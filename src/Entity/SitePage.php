<?php

namespace App\Entity;

use App\Repository\SitePageRepository;
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
    private $parent_menu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $route_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $route_path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $background;

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

    public function getParentMenu(): ?string
    {
        return $this->parent_menu;
    }

    public function setParentMenu(string $parent_menu): self
    {
        $this->parent_menu = $parent_menu;

        return $this;
    }

    public function getRouteName(): ?string
    {
        return $this->route_name;
    }

    public function setRouteName(string $route_name): self
    {
        $this->route_name = $route_name;

        return $this;
    }

    public function getRoutePath(): ?string
    {
        return $this->route_path;
    }

    public function setRoutePath(string $route_path): self
    {
        $this->route_path = $route_path;

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

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): self
    {
        $this->background = $background;

        return $this;
    }
}
