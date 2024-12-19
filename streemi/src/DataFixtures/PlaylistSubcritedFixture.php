<?php

namespace App\DataFixtures;

use App\Entity\PlaylistSubcription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PlaylistSubcritedFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $playlistsSubcription = [
            ['playlist' => 'playlist_1', 'user' => 'user_0'],
            ['playlist' => 'playlist_0', 'user' => 'user_0'],
        ];

        foreach ($playlistsSubcription as $index => $data) {
            $playlistSubcription = new PlaylistSubcription();
            $playlistSubcription->setSubscriber($this->getReference($data['user']));
            $playlistSubcription->setPlaylist($this->getReference($data['playlist']));
            $playlistSubcription->setSubcribedAt(new \DateTimeImmutable());
            $manager->persist($playlistSubcription);

            $this->addReference('playlist_subscribed_' . $index, $playlistSubcription);
        }
        
        $manager->flush();
    
    }

    public function getDependencies(): array
    {
        return [UserFixture::class];
    }
}
