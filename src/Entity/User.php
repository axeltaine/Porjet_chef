<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

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

    public function getUsername()
    {
        return $this->Name_user;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->Mdp_user;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }
}
