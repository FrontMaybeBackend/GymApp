<?php

namespace App\Entity;

use App\Repository\MessengerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessengerRepository::class)]
class Messenger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?User $FromUser = null;

    #[ORM\Column(length: 255)]
    private ?User $ToUsers = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromUser(): ?User
    {
        return $this->FromUser;
    }

    public function setFromUser(User $FromUser): static
    {
        $this->FromUser = $FromUser;

        return $this;
    }

    public function getToUsers(): ?User
    {
        return $this->ToUsers;
    }

    public function setToUsers(User $ToUsers): static
    {
        $this->ToUsers = $ToUsers;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
