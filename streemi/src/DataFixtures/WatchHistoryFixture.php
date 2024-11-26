<?php

namespace App\DataFixtures;

use App\Entity\WatchHistory;
use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WatchHistoryFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $histories = [
            ['viewer' => 'user_0', 'media' => 'media_0', 'lastWatched' => new \DateTime('-1 day'), 'number_of_view'=>1200],
            ['viewer' => 'user_1', 'media' => 'media_1', 'lastWatched' => new \DateTime('-2 days'),'number_of_view'=>300],
        ];

        foreach ($histories as $index => $data) {
            $media = $this->getReference($data['media']);
            $viewer = $this->getReference($data['viewer']);

            // Validation pour s'assurer que les références sont valides
            if (!$media instanceof Media) {
                throw new \LogicException(sprintf('The reference "%s" is not a Media instance.', $data['media']));
            }
            $watchHistory = new WatchHistory();
            $watchHistory->setViewer($viewer);
            $watchHistory->setNumberOfView($data['number_of_view']);
            $watchHistory->setMedia($media);
            $watchHistory->setLastWatched($data['lastWatched']);

            $manager->persist($watchHistory);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
            MovieFixtures::class, // Ou SerieFixtures selon les dépendances
        ];
    }
}
