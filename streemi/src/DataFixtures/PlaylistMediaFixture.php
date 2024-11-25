<?php

namespace App\DataFixtures;

use App\Entity\PlaylistMedia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaylistMediaFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Example of adding playlist items
        $playlistMedia = new PlaylistMedia();
        $playlistMedia->setMedia($this->getReference('movie_0')); // Reference to a movie
        $manager->persist($playlistMedia);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [MovieFixtures::class, SerieFixtures::class];
    }
}
