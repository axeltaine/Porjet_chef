<?php

namespace App\Entity;

use App\Entity\Projet;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="text")
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
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="projets")
     */
    private $company;


    private $date_contact;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chat", mappedBy="projet")
     */
    private $chats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="assignedProjets")
     */
    private $assignedUsers;

    /**
     * @ORM\Column(type="integer")
     */
    private $Position;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Data", mappedBy="dataprojet", cascade={"persist", "remove"})
     */
    private $data;

    public function __construct()
    {
        $this->chats = new ArrayCollection();
        $this->assignedUsers = new ArrayCollection();
    }

    
    public function getDateContact()
    {
        return date_modify(new \DateTime($this->Date_end->format('Y-m-d')), '-1 month');
    }

    public function setDateContact(\DateTime $date_contact): self
    {
        $this->date_contact = $date_contact;

        return $this;
    }
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

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

    /**
     * @return Collection|Chat[]
     */
    public function getChats(): Collection
    {
        return $this->chats;
    }

    public function addChat(Chat $chat): self
    {
        if (!$this->chats->contains($chat)) {
            $this->chats[] = $chat;
            $chat->setProjet($this);
        }

        return $this;
    }

    public function removeChat(Chat $chat): self
    {
        if ($this->chats->contains($chat)) {
            $this->chats->removeElement($chat);
            // set the owning side to null (unless already changed)
            if ($chat->getProjet() === $this) {
                $chat->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAssignedUsers(): Collection
    {
        return $this->assignedUsers;
    }

    public function addAssignedUser(User $assignedUser): self
    {
        if (!$this->assignedUsers->contains($assignedUser)) {
            $this->assignedUsers[] = $assignedUser;
        }

        return $this;
    }

    public function removeAssignedUser(User $assignedUser): self
    {
        if ($this->assignedUsers->contains($assignedUser)) {
            $this->assignedUsers->removeElement($assignedUser);
        }

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->Position;
    }

    public function setPosition(int $Position): self
    {
        $this->Position = $Position;

        return $this;
    }

    public function getData(): ?Data
    {
        return $this->data;
    }

    public function setData(?Data $data): self
    {
        $this->data = $data;

        // set (or unset) the owning side of the relation if necessary
        $newDataprojet = $data === null ? null : $this;
        if ($newDataprojet !== $data->getDataprojet()) {
            $data->setDataprojet($newDataprojet);
        }

        return $this;
    }
}
