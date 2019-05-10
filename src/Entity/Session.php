<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->sessions = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participer", mappedBy="session")
     */
    private $sessions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Participer[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Participer $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setSession($this);
        }

        return $this;
    }

    public function removeSession(Participer $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getSession() === $this) {
                $session->setSession(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return (string) $this->getDate()->format('d/m/YYYY');
    }
}
