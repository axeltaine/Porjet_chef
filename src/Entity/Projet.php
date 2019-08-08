<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
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
    private $name_projet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $desc_projet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProjet(): ?string
    {
        return $this->name_projet;
    }

    public function setNameProjet(string $name_projet): self
    {
        $this->name_projet = $name_projet;

        return $this;
    }

    public function getDescProjet(): ?string
    {
        return $this->desc_projet;
    }

    public function setDescProjet(string $desc_projet): self
    {
        $this->desc_projet = $desc_projet;

        return $this;
    }

    public function getImgProjet(): ?string
    {
        return $this->img_projet;
    }

    public function setImgProjet(string $img_projet): self
    {
        $this->img_projet = $img_projet;

        return $this;
    }
}
