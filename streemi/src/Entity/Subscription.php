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
    private ?User $subcriber = null;

    /**
     * @var Collection<int, SubcriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'subcription', orphanRemoval: true)]
    private Collection $subcriptionHistories;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'subscription')]
    private Collection $subscriptionHistories;

    public function __construct()
    {
        $this->subcriptionHistories = new ArrayCollection();
        $this->subscriptionHistories = new ArrayCollection();
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

    public function getSubcriber(): ?User
    {
        return $this->subcriber;
    }

    public function setSubcriber(?User $subcriber): static
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

    public function addSubcriptionHistory(SubscriptionHistory $subcriptionHistory): static
    {
        if (!$this->subcriptionHistories->contains($subcriptionHistory)) {
            $this->subcriptionHistories->add($subcriptionHistory);
            $subcriptionHistory->setSubscription($this);
        }

        return $this;
    }

    public function removeSubcriptionHistory(SubscriptionHistory $subcriptionHistory): static
    {
        if ($this->subcriptionHistories->removeElement($subcriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subcriptionHistory->getSubscription() === $this) {
                $subcriptionHistory->setSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getSubscriptionHistories(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
            $this->subscriptionHistories->add($subscriptionHistory);
            $subscriptionHistory->setSubscription($this);
        }

        return $this;
    }

    public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionHistory->getSubscription() === $this) {
                $subscriptionHistory->setSubscription(null);
            }
        }

        return $this;
    }
}
