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
    private ?Playlist $playlist = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubcriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $subscriber = null;

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

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getSubscriber(): ?User
    {
        return $this->subscriber;
    }

    public function setSubscriber(?User $subscriber): static
    {
        $this->subscriber = $subscriber;

        return $this;
    }
}
