<?php

namespace App\Entity;

use App\Entity\Company;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
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
    private $Name_company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name_director;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Siret_company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Phone_company;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email_company;
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Projet", mappedBy="company")
     */
    private $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

    /**
     * @return Collection|Projet[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    // addProjet() and removeProjet() were also added

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCompany(): ?string
    {
        return $this->Name_company;
    }

    public function setNameCompany(string $Name_company): self
    {
        $this->Name_company = $Name_company;

        return $this;
    }

    public function getNameDirector(): ?string
    {
        return $this->Name_director;
    }

    public function setNameDirector(string $Name_director): self
    {
        $this->Name_director = $Name_director;

        return $this;
    }

    public function getSiretCompany(): ?string
    {
        return $this->Siret_company;
    }

    public function setSiretCompany(string $Siret_company): self
    {
        $this->Siret_company = $Siret_company;

        return $this;
    }

    public function getPhoneCompany(): ?string
    {
        return $this->Phone_company;
    }

    public function setPhoneCompany(string $Phone_company): self
    {
        $this->Phone_company = $Phone_company;

        return $this;
    }

    public function getEmailCompany(): ?string
    {
        return $this->Email_company;
    }

    public function setEmailCompany(string $Email_company): self
    {
        $this->Email_company = $Email_company;

        return $this;
    }
}
