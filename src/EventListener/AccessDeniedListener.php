<?php

// src/EventListener/AccessDeniedListener.php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccessDeniedListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            // the priority must be greater than the Security HTTP
            // ExceptionListener, to make sure it's called before
            // the default exception listener
            KernelEvents::EXCEPTION => ['onKernelException', 2],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof AccessDeniedException) {
            return;
        }

        $referer = $event->getRequest()->headers->get('referer');
        $response = new RedirectResponse($referer);

        $session = $event->getRequest()->getSession();
        $session->getFlashBag()->add('error', 'Vous n\'avez pas les droits pour accéder à cette page.');

        $event->setResponse($response);
    }
}