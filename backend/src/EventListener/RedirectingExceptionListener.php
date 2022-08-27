<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsEventListener(event: ExceptionEvent::class, priority: 1)]
class RedirectingExceptionListener
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();
        $exception = $event->getThrowable();

        if (!$request->isXmlHttpRequest() && $exception instanceof NotFoundHttpException) {
            $response = new RedirectResponse($this->urlGenerator->generate('app_index'));
            $event->setResponse($response);
            $event->stopPropagation();
        }
    }
}
