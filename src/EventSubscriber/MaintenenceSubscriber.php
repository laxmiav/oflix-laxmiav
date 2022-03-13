<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class MaintenenceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event)
    {
       $response = $event->getResponse();

    $replace = str_replace('<body>','<body><div class="alert alert-danger">Maintenance prévue mardi 10 janvier à 17h00</div>',$response);
     //$response->request->set('<body>', $replace);
       //dump($replace);
    }







    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => 'onKernelResponse',
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}
