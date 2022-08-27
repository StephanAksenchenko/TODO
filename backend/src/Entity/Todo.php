<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
    public const AVAILABLE_STATUSES = ['new', 'progress', 'done'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private string $status = 'new';

    #[ORM\Column(length: 255)]
    private string $title;

    public function __construct(string $title)
    {
        $this->setTitle($title);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $status = strtolower(trim($status));

        Assert::that($status, defaultMessage: 'Статус TODO должен быть представлен одной из строк: "' . implode('", "', self::AVAILABLE_STATUSES) . '"!')
            ->notBlank()
            ->choice(self::AVAILABLE_STATUSES);

        $this->status = $status;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $title = trim($title);

        Assert::that($title, 'Заголовок TODO должен быть представлен непустой строкой длиной до 255 символов!')
            ->string()
            ->notBlank()
            ->maxLength(255);

        $this->title = $title;

        return $this;
    }
}
