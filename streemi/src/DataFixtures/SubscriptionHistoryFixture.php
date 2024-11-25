<?php

namespace App\DataFixtures;

use App\Entity\SubscriptionHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubscriptionHistoryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $subscriptionHistory = new SubscriptionHistory();
        $subscriptionHistory->setSubcriber($this->getReference('user_0'));
        $subscriptionHistory->setSubscription($this->getReference('subscription_0'));
        $subscriptionHistory->setStartDate(new \DateTime());
        $subscriptionHistory->setEndDate((new \DateTime())->modify('+30 days'));

        $manager->persist($subscriptionHistory);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixture::class, SubscriptionFixture::class];
    }
}
