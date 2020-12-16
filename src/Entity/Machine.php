<?php

namespace App\Entity;

use App\Repository\MachineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MachineRepository::class)
 */
class Machine
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
    private $ipadresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $macadresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="machines")
     */
    private $salle;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="machines")
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIpadresse(): ?string
    {
        return $this->ipadresse;
    }

    public function setIpadresse(string $ipadresse): self
    {
        $this->ipadresse = $ipadresse;

        return $this;
    }

    public function getMacadresse(): ?string
    {
        return $this->macadresse;
    }

    public function setMacadresse(string $macadresse): self
    {
        $this->macadresse = $macadresse;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }
    public function __toString()
    {
        return $this->nom;
    }


    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}
