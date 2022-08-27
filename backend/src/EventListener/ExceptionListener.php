<?php

namespace App\EventListener;

use App\Controller\Traits\HttpExceptionNormalizerTrait;
use App\Controller\Traits\JsonResponseFormatterTrait;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

#[AsEventListener(event: ExceptionEvent::class, priority: 0)]
class ExceptionListener
{
    use HttpExceptionNormalizerTrait;
    use JsonResponseFormatterTrait;

    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();

        if (!$event->isPropagationStopped() && $request->isXmlHttpRequest()) {
            $exception = $event->getThrowable();
            $response = new JsonResponse(
                $this->error($exception->getMessage()),
                $this->normalizeHttpExceptionCode($exception->getCode())
            );

            $event->setResponse($response);
            $event->stopPropagation();
        }
    }
}
