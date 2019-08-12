<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $Name_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Mdp_user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameUser(): ?string
    {
        return $this->Name_user;
    }

    public function setNameUser(string $Name_user): self
    {
        $this->Name_user = $Name_user;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->Mdp_user;
    }

    public function setMdpUser(string $Mdp_user): self
    {
        $this->Mdp_user = $Mdp_user;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->Email_user;
    }

    public function setEmailUser(string $Email_user): self
    {
        $this->Email_user = $Email_user;

        return $this;
    }
}
