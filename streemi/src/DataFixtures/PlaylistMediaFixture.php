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
        for ($i = 0; $i < 5; $i++) {
            $playlistMedia = new PlaylistMedia();
            $playlistMedia->setMedia($this->getReference("media_$i")); // Utilisation de références génériques
            $playlistMedia->setPlaylist($this->getReference("playlist_0")); // Exemple de référence à une playlist
            $playlistMedia->setAddedAt(new \DateTimeImmutable());
            $manager->persist($playlistMedia);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MovieFixtures::class,
            SerieFixtures::class,
            PlaylistFixture::class,
        ];
    }
}
