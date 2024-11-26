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
            ['type' => 'Basic', 'price' => 9.99, 'duration' => 30, "name" => "Basic"],
            ['type' => 'Premium', 'price' => 14.99, 'duration' => 30 , "name" => "Premium"],
            ['type' => 'VIP', 'price' => 19.99, 'duration' => 30, "name" => "VIP"],
        ];

        foreach ($subscriptions as $index => $data) {
            $subscription = new Subscription();
            $subscription->setSubcriber($this->getReference('user_0'));
            $subscription->setName($data['name']);
            $subscription->setPrice($data['price']);
            $subscription->setDurationInMonth($data['duration']);
            $manager->persist($subscription);

            $this->addReference('subscription_' . $index, $subscription);
        }

        $manager->flush();
    }
}
