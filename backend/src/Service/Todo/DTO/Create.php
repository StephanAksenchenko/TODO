<?php

namespace App\Service\Todo\DTO;

use App\Entity\Todo;
use Assert\Assert;

class Create
{
    public const TITLE_KEY = 'title';

    public function __construct(public readonly string $title)
    {
    }

    public function create(): Todo
    {
        return new Todo($this->title);
    }

    public static function fromArray(array $array): self
    {
        Assert::lazy()
            ->tryAll()
            ->that($array, defaultMessage: 'Укажите параметр "title"!')->notEmptyKey(self::TITLE_KEY)->string()
            ->verifyNow();

        return new self($array[self::TITLE_KEY]);
    }
}
