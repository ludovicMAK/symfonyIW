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

    #[ORM\ManyToOne(inversedBy: 'playlistSubcriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?playlist $playlist = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubcriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $subscriber = null;

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

    public function getPlaylist(): ?playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getSubscriber(): ?user
    {
        return $this->subscriber;
    }

    public function setSubscriber(?user $subscriber): static
    {
        $this->subscriber = $subscriber;

        return $this;
    }
}
