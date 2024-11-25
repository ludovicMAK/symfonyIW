<?php

namespace App\DataFixtures;

use App\Entity\WatchHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WatchHistoryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $watchHistory = new WatchHistory();
        $watchHistory->setViewer($this->getReference('user_0'));
        $watchHistory->setMedia($this->getReference('movie_0'));
        $watchHistory->setLastWatched(new \DateTime());

        $manager->persist($watchHistory);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixture::class, MovieFixtures::class];
    }
}
