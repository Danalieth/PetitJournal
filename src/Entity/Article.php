<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dat_crea;

    /**
     * @ORM\Column(type="datetime")
     */
    private $der_maj;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;

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

    public function getDatCrea(): ?\DateTimeInterface
    {
        return $this->dat_crea;
    }

    public function setDatCrea(\DateTimeInterface $dat_crea): self
    {
        $this->dat_crea = $dat_crea;

        return $this;
    }

    public function getDerMaj(): ?\DateTimeInterface
    {
        return $this->der_maj;
    }

    public function setDerMaj(\DateTimeInterface $der_maj): self
    {
        $this->der_maj = $der_maj;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
