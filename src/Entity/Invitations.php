<?php

namespace App\Entity;

use App\Repository\InvitationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitationsRepository::class)]
class Invitations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'sender', targetEntity: User::class)]
    private Collection $sender;

    #[ORM\ManyToOne(inversedBy: 'receiver')]
    private ?User $receiver = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $status = null;

    public function __construct()
    {
        $this->sender = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getSender(): Collection
    {
        return $this->sender;
    }

    public function addSender(User $sender): static
    {
        if (!$this->sender->contains($sender)) {
            $this->sender->add($sender);
            $sender->setSender($this);
        }

        return $this;
    }

    public function removeSender(User $sender): static
    {
        if ($this->sender->removeElement($sender)) {
            // set the owning side to null (unless already changed)
            if ($sender->getSender() === $this) {
                $sender->setSender(null);
            }
        }

        return $this;
    }

    public function getReceiver(): ?User
    {
        return $this->receiver;
    }

    public function setReceiver(?User $receiver): static
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
