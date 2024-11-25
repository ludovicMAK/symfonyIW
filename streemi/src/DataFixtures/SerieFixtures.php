<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SerieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $series = [
            [
                'title' => 'Game of Thrones',
                'shortDescription' => 'A fantasy drama series.',
                'longDescription' => 'Nine noble families fight for control over the lands of Westeros.',
                'releaseDate' => new \DateTime('2011-04-17'),
                'coverImage' => 'game_of_thrones.jpg',
                'staff' => ['David Benioff', 'D.B. Weiss'],
                'casting' => ['Emilia Clarke', 'Kit Harington'],
                'categories' => [0, 1], // References to categories
            ],
            [
                'title' => 'Stranger Things',
                'shortDescription' => 'A sci-fi thriller.',
                'longDescription' => 'When a young boy vanishes, a small town uncovers a mystery.',
                'releaseDate' => new \DateTime('2016-07-15'),
                'coverImage' => 'stranger_things.jpg',
                'staff' => ['The Duffer Brothers'],
                'casting' => ['Winona Ryder', 'David Harbour'],
                'categories' => [1],
            ],
        ];

        foreach ($series as $data) {
            $serie = new Serie();
            $serie->setTitle($data['title']);
            $serie->setShortDescription($data['shortDescription']);
            $serie->setLongDescription($data['longDescription']);
            $serie->setReleaseDate($data['releaseDate']);
            $serie->setCoverImage($data['coverImage']);
            $serie->setStaff($data['staff']);
            $serie->setCasting($data['casting']);

            foreach ($data['categories'] as $categoryIndex) {
                $serie->addCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE . $categoryIndex));
            }

            $manager->persist($serie);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
