<?php

namespace App\Controller;

use App\Controller\Traits\JsonResponseFormatterTrait;
use App\Service\Todo\DTO\Create;
use App\Service\Todo\DTO\Update;
use App\Service\Todo\TodoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/todo', name: 'todo_')]
class TodoController extends AbstractController
{
    use JsonResponseFormatterTrait;

    public function __construct(private readonly TodoService $todoService)
    {
    }

    #[Route(path: '', name: 'get_all', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        return new JsonResponse($this->data($this->todoService->getAll()));
    }

    #[Route(path: '/{id<\d+>}', name: 'get_by_id', methods: ['GET'])]
    public function getById($id): JsonResponse
    {
        return new JsonResponse($this->data($this->todoService->getById($id)));
    }

    #[Route(path: '/create', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->data(
                $this->todoService->create(
                    Create::fromArray($request->request->all())
                )
            )
        );
    }

    #[Route(path: '/{id<\d+>}/update', name: 'update', methods: ['POST'])]
    public function update(int $id, Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->data(
                $this->todoService->update(
                    Update::fromArray(array_merge($request->request->all(), ['id' => $id]))
                )
            )
        );
    }

    #[Route(path: '/{id<\d+>}/delete', name: 'delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->todoService->delete($id);

        return new JsonResponse();
    }
}
