<?php

namespace App\Service\Todo\DTO;

use App\Entity\Todo;

class Output
{
    public function __construct(
        public readonly int $id,
        public readonly string $status,
        public readonly string $title
    ) {
    }

    public static function fromEntity(Todo $todo): self
    {
        return new self(
            $todo->getId(),
            $todo->getStatus(),
            $todo->getTitle()
        );
    }
}
