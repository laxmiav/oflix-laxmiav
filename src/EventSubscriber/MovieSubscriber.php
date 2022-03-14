<?php

namespace App\EventSubscriber;

use App\Service\Myslugger;
use Doctrine\ORM\Events;
use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

class MovieSubscriber implements EventSubscriberInterface
{
    private $slugger;

    public function __construct(Myslugger $slugger)
    {
        $this->slugger = $slugger;

    }

    public function preUpdate(PreUpdateEventArgs $event)
    {
        $movie = $event->getObject();

        if ($movie instanceof Movie)
        {
            $slug = $this->slugger->slugify($movie->getTitle());
            $movie->setSlug($slug);
        }
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
        ];
    }
}
