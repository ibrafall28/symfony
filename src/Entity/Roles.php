<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RolesRepository::class)
 */
class Roles
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
    private $nom;

   

    /**
     * @ORM\ManyToMany(targetEntity=Roles::class, mappedBy="users")
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="role")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->role = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(self $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
            $role->addUser($this);
        }

        return $this;
    }

    public function removeRole(self $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            $role->removeUser($this);
        }

        return $this;
    }
}
