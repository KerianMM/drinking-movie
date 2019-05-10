<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticiperRepository")
 */
class Participer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="participers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }
}
