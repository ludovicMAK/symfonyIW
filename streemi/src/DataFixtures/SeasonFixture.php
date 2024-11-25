<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $seasons = [
            ['number' => 1, 'serie' => 'serie_0'],
            ['number' => 2, 'serie' => 'serie_0'],
        ];

        foreach ($seasons as $index => $data) {
            $season = new Season();
            $season->setSeasonNumber($data['number']);
            $season->addMedium($this->getReference($data['serie']));
            $manager->persist($season);

            $this->addReference('season_' . $index, $season);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SerieFixtures::class];
    }
}
