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

    #[ORM\OneToMany(mappedBy: 'shipper', targetEntity: User::class)]
    private Collection $shipper;

    #[ORM\OneToMany(mappedBy: 'receiver', targetEntity: User::class)]
    private Collection $receiver;

    #[ORM\Column(nullable: true)]
    private ?bool $status = null;

    public function __construct()
    {
        $this->shipper = new ArrayCollection();
        $this->receiver = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getShipper(): Collection
    {
        return $this->shipper;
    }

    public function addShipper(User $shipper): static
    {
        if (!$this->shipper->contains($shipper)) {
            $this->shipper->add($shipper);
            $shipper->setShipper($this);
        }

        return $this;
    }

    public function removeShipper(User $shipper): static
    {
        if ($this->shipper->removeElement($shipper)) {
            // set the owning side to null (unless already changed)
            if ($shipper->getShipper() === $this) {
                $shipper->setShipper(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getReceiver(): Collection
    {
        return $this->receiver;
    }

    public function addReceiver(User $receiver): static
    {
        if (!$this->receiver->contains($receiver)) {
            $this->receiver->add($receiver);
            $receiver->setReceiver($this);
        }

        return $this;
    }

    public function removeReceiver(User $receiver): static
    {
        if ($this->receiver->removeElement($receiver)) {
            // set the owning side to null (unless already changed)
            if ($receiver->getReceiver() === $this) {
                $receiver->setReceiver(null);
            }
        }

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }
}
