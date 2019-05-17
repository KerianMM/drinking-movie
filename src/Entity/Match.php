<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 * @ORM\Table(name="`match`")
 */
class Match
{
    /**
     * @Groups({"read"})
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"read", "write"})
     *
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @Groups({"read"})
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Session")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    /**
     * @Groups({"read"})
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $participant;

    /**
     * @Groups({"read"})
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Rule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
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

    public function getRule(): ?Rule
    {
        return $this->rule;
    }

    public function setRule(?Rule $rule): self
    {
        $this->rule = $rule;

        return $this;
    }
}
