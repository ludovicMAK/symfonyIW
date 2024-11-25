<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'shortDescription' => 'A mind-bending thriller.',
                'longDescription' => 'A thief uses dream-sharing technology to plant an idea.',
                'releaseDate' => new \DateTime('2010-07-16'),
                'coverImage' => 'inception.jpg',
                'staff' => ['Christopher Nolan'],
                'casting' => ['Leonardo DiCaprio', 'Joseph Gordon-Levitt'],
                'categories' => [0, 1], // References to categories
            ],
            [
                'title' => 'Shrek',
                'shortDescription' => 'A comedic fairy tale.',
                'longDescription' => 'An ogre rescues a princess.',
                'releaseDate' => new \DateTime('2001-05-18'),
                'coverImage' => 'shrek.jpg',
                'staff' => ['Andrew Adamson', 'Vicky Jenson'],
                'casting' => ['Mike Myers', 'Eddie Murphy'],
                'categories' => [2],
            ],
        ];

        foreach ($movies as $data) {
            $movie = new Movie();
            $movie->setTitle($data['title']);
            $movie->setShortDescription($data['shortDescription']);
            $movie->setLongDescription($data['longDescription']);
            $movie->setReleaseDate($data['releaseDate']);
            $movie->setCoverImage($data['coverImage']);
            $movie->setStaff($data['staff']);
            $movie->setCasting($data['casting']);

            foreach ($data['categories'] as $categoryIndex) {
                $movie->addCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE . $categoryIndex));
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
