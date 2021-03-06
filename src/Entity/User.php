<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Avatar;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projet", mappedBy="assignedUsers")
     */
    private $assignedProjets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Log", mappedBy="User")
     */
    private $logs;

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->assignedProjets = new ArrayCollection();
        $this->logs = new ArrayCollection();
       
    }

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

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

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
        $roles = $this->userRoles->map(function($role){
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
    }
    public function eraseCredentials()
    {
    }

    public function getAvatar(): ?string
    {
        return $this->Avatar;
    }

    public function setAvatar(string $Avatar): self
    {
        $this->Avatar = $Avatar;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getAssignedProjets(): Collection
    {
        return $this->assignedProjets;
    }

    public function addAssignedProjet(Projet $assignedProjet): self
    {
        if (!$this->assignedProjets->contains($assignedProjet)) {
            $this->assignedProjets[] = $assignedProjet;
            $assignedProjet->addAssignedUser($this);
        }

        return $this;
    }

    public function removeAssignedProjet(Projet $assignedProjet): self
    {
        if ($this->assignedProjets->contains($assignedProjet)) {
            $this->assignedProjets->removeElement($assignedProjet);
            $assignedProjet->removeAssignedUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Log[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setUser($this);
        }

        return $this;
    }

    public function removeLog(Log $log): self
    {
        if ($this->logs->contains($log)) {
            $this->logs->removeElement($log);
            // set the owning side to null (unless already changed)
            if ($log->getUser() === $this) {
                $log->setUser(null);
            }
        }

        return $this;
    }
}
