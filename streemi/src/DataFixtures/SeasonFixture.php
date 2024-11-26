<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $seasons = [
            ['number' => 1, 'serie' => 'media_5'], // Série 1
            ['number' => 2, 'serie' => 'media_5'], // Série 1
            ['number' => 1, 'serie' => 'media_6'], // Série 2
        ];

        foreach ($seasons as $index => $data) {
            $serie = $this->getReference($data['serie']);

            // Vérifier que la référence est bien une instance de Serie
            if (!$serie instanceof Serie) {
                throw new \LogicException(sprintf('The reference "%s" is not a Serie instance.', $data['serie']));
            }

            $season = new Season();
            $season->setSeasonNumber($data['number']);
            $season->addMedium($serie); // Lier la saison à la série
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
