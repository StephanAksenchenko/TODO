<?php

namespace App\Service\Todo;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use App\Service\Todo\DTO\Create;
use App\Service\Todo\DTO\Output;
use App\Service\Todo\DTO\Update;

class TodoService
{
    public function __construct(private readonly TodoRepository $repository)
    {
    }

    /**
     * @return Output[]
     */
    public function getAll(): array
    {
        $todos = $this->repository->findAll();

        return array_map(
            function (Todo $todo) {
                return Output::fromEntity($todo);
            },
            $todos
        );
    }

    public function getById(int $id): Output
    {
        $todo = $this->repository->find($id);

        if (null === $todo) {
            throw new \DomainException('TODO #' . $id . ' was not found!');
        }

        return Output::fromEntity($todo);
    }

    public function create(Create $create): Output
    {
        $todo = $create->create();

        $this->repository->add($todo, true);

        return Output::fromEntity($todo);
    }

    public function update(Update $update): Output
    {
        $todo = $this->repository->find($update->id);

        if (null === $todo) {
            throw new \DomainException('TODO #' . $update->id . ' was not found!');
        }

        $this->repository->add($update->update($todo), true);

        return Output::fromEntity($todo);
    }

    public function delete(int $id): void
    {
        $todo = $this->repository->find($id);

        if (null === $todo) {
            throw new \DomainException('TODO #' . $id . ' was not found!');
        }

        $this->repository->remove($todo, true);
    }
}
