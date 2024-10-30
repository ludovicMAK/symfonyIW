<?php

namespace App\Entity;

use App\Repository\SubscriptionHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionHistoryRepository::class)]
class SubscriptionHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'subscriptionHistories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $subcriber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubcriber(): ?user
    {
        return $this->subcriber;
    }

    public function setSubcriber(?user $subcriber): static
    {
        $this->subcriber = $subcriber;

        return $this;
    }
}
