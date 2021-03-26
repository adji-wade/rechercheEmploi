<?php

namespace App\Entity;

use App\Repository\DemandeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=DemandeurRepository::class)
 */
class Demandeur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=CV::class, mappedBy="demandeur")
     */
    private $cvUsers;

    public function __construct()
    {
        $this->cvUsers = new ArrayCollection();
    }
  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|CV[]
     */
    public function getCvUsers(): Collection
    {
        return $this->cvUsers;
    }

    public function addCvUser(CV $cvUser): self
    {
        if (!$this->cvUsers->contains($cvUser)) {
            $this->cvUsers[] = $cvUser;
            $cvUser->setDemandeur($this);
        }

        return $this;
    }

    public function removeCvUser(CV $cvUser): self
    {
        if ($this->cvUsers->removeElement($cvUser)) {
            // set the owning side to null (unless already changed)
            if ($cvUser->getDemandeur() === $this) {
                $cvUser->setDemandeur(null);
            }
        }

        return $this;
    }
    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }
}
