<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $durationInMonth = null;

    #[ORM\ManyToOne(inversedBy: 'subscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $subcriber = null;

    /**
     * @var Collection<int, SubcriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubcriptionHistory::class, mappedBy: 'subcription', orphanRemoval: true)]
    private Collection $subcriptionHistories;

    public function __construct()
    {
        $this->subcriptionHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDurationInMonth(): ?int
    {
        return $this->durationInMonth;
    }

    public function setDurationInMonth(int $durationInMonth): static
    {
        $this->durationInMonth = $durationInMonth;

        return $this;
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

    /**
     * @return Collection<int, SubcriptionHistory>
     */
    public function getSubcriptionHistories(): Collection
    {
        return $this->subcriptionHistories;
    }

    public function addSubcriptionHistory(SubcriptionHistory $subcriptionHistory): static
    {
        if (!$this->subcriptionHistories->contains($subcriptionHistory)) {
            $this->subcriptionHistories->add($subcriptionHistory);
            $subcriptionHistory->setSubcription($this);
        }

        return $this;
    }

    public function removeSubcriptionHistory(SubcriptionHistory $subcriptionHistory): static
    {
        if ($this->subcriptionHistories->removeElement($subcriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subcriptionHistory->getSubcription() === $this) {
                $subcriptionHistory->setSubcription(null);
            }
        }

        return $this;
    }
}
