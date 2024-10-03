<?php

namespace App\Entity;

use App\Repository\PlaylistSubcriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubcriptionRepository::class)]
class PlaylistSubcription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $subcribedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubcribedAt(): ?\DateTimeImmutable
    {
        return $this->subcribedAt;
    }

    public function setSubcribedAt(\DateTimeImmutable $subcribedAt): static
    {
        $this->subcribedAt = $subcribedAt;

        return $this;
    }
}
