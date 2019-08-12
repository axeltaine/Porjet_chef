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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Name_domain;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Logo_projet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Doc_projet;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_start;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_end;

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

    public function getNameDomain(): ?string
    {
        return $this->Name_domain;
    }

    public function setNameDomain(?string $Name_domain): self
    {
        $this->Name_domain = $Name_domain;

        return $this;
    }

    public function getLogoProjet(): ?string
    {
        return $this->Logo_projet;
    }

    public function setLogoProjet(string $Logo_projet): self
    {
        $this->Logo_projet = $Logo_projet;

        return $this;
    }

    public function getDocProjet(): ?string
    {
        return $this->Doc_projet;
    }

    public function setDocProjet(string $Doc_projet): self
    {
        $this->Doc_projet = $Doc_projet;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->Date_start;
    }

    public function setDateStart(\DateTimeInterface $Date_start): self
    {
        $this->Date_start = $Date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->Date_end;
    }

    public function setDateEnd(\DateTimeInterface $Date_end): self
    {
        $this->Date_end = $Date_end;

        return $this;
    }
}
