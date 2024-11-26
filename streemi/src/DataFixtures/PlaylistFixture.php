<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaylistFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $playlists = [
            ['name' => 'Top Action Movies', 'user' => 'user_0'],
            ['name' => 'Dramatic Series', 'user' => 'user_0'],
        ];

        foreach ($playlists as $index => $data) {
            $playlist = new Playlist();
            $playlist->setName($data['name']);
            $playlist->setCreatedAt(new \DateTimeImmutable());
            $playlist->setCreatedBy($this->getReference($data['user']));
            $playlist->setUpdatedAt(new \DateTimeImmutable());
            $manager->persist($playlist);

            $this->addReference('playlist_' . $index, $playlist);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixture::class];
    }
}
