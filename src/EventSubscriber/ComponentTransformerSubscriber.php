<?php

namespace App\EventSubscriber;

use App\Controller\ComponentController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ComponentTransformerSubscriber implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        if (is_array($controller) && $controller[0] instanceof ComponentController) {
            $request = $event->getRequest();
            $component = $request->attributes->get('component');

            $transformedComponent = $this->transformComponent($component);

            $request->attributes->set('component', $transformedComponent);
        }
    }

    private function transformComponent($component): string
    {
        $component = explode('-', $component);
        return implode('/', $component);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
