<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscriptions = [
            ['type' => 'Basic', 'price' => 9.99, 'duration' => 30],
            ['type' => 'Premium', 'price' => 14.99, 'duration' => 30],
        ];

        foreach ($subscriptions as $index => $data) {
            $subscription = new Subscription();
            $subscription->setPrice($data['price']);
            $subscription->setDurationInMonth($data['duration']);
            $manager->persist($subscription);

            $this->addReference('subscription_' . $index, $subscription);
        }

        $manager->flush();
    }
}
