<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episodes = [
            ['title' => 'Pilot', 'season' => 'season_0'],
            ['title' => 'Second Episode', 'season' => 'season_0'],
        ];

        foreach ($episodes as $index => $data) {
            $episode = new Episode();
            $episode->setTitle($data['title']);
            $episode->setDuration(42);
            $episode->setSeason($this->getReference($data['season']));
            $episode->setReleaseDate(new \DateTime());
            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SeasonFixture::class];
    }
}
