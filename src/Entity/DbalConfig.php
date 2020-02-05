<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DbalConfigRepository")
 */
class DbalConfig
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlDbal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resourse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlDbal(): ?string
    {
        return $this->urlDbal;
    }

    public function setUrlDbal(?string $urlDbal): self
    {
        $this->urlDbal = $urlDbal;

        return $this;
    }

    public function getResourse(): ?string
    {
        return $this->resourse;
    }

    public function setResourse(?string $resourse): self
    {
        $this->resourse = $resourse;

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getResourse();
    }
}
