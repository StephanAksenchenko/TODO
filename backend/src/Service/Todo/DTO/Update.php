<?php

namespace App\Service\Todo\DTO;

use App\Entity\Todo;
use Assert\Assert;

class Update
{
    public const ID_KEY = 'id';
    public const STATUS_KEY = 'status';

    public function __construct(public readonly int $id, public readonly string $status, public readonly string $title)
    {
    }

    public function update(Todo $todo): Todo
    {
        return $todo->setStatus($this->status)
            ->setTitle($this->title);
    }

    public static function fromArray(array $array): self
    {
        Assert::lazy()
            ->tryAll()
            ->that($array, defaultMessage: 'Укажите параметр "id"!')->notEmptyKey(self::ID_KEY)->integer()
            ->that($array, defaultMessage: 'Укажите параметр "status"!')->notEmptyKey(self::STATUS_KEY)->string()
            ->that($array, defaultMessage: 'Укажите параметр "title"!')->notEmptyKey(self::TITLE_KEY)->string()
            ->verifyNow();

        return new self($array[self::ID_KEY], $array[self::STATUS_KEY], $array[Create::TITLE_KEY]);
    }
}
