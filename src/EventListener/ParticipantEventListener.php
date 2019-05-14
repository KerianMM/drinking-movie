<?php

namespace App\EventListener;

use App\Entity\Participant;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantEventListener
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $participant = $args->getObject();

        if($participant instanceof Participant && $participant->getPlainTextPassword() !== null)
        {
            $participant
                ->setPassword($this->encoder->encodePassword($participant, $participant->getPlainTextPassword()))
                ->setPlainTextPassword(null)
            ;
        }
    }

}