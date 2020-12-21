<?php

namespace App\Entity;

use App\Repository\PagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PagesRepository::class)
 */
class Pages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $body;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", length=65535, nullable=false)
     */
    private $metatitle;

    /**
     * @ORM\Column(type="text", length=65535, nullable=false)
     */
    private $keywords;

    /**
     * @ORM\Column(type="text", length=65535, nullable=false)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMetatitle(): ?string
    {
        return $this->metatitle;
    }

    public function setMetatitle(string $metatitle): self
    {
        $this->metatitle = $metatitle;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): self
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
