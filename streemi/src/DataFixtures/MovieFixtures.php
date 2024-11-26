<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $movie = new Movie();
            $movie->setTitle("Movie $i");
            $movie->setShortDescription("Short description of movie $i");
            $movie->setLongDescription("Long description of movie $i");
            $movie->setReleaseDate(new \DateTime());
            $movie->setCoverImage("movie$i.jpg");
            $manager->persist($movie);

            // Ajout de la référence générique
            $this->addReference("media_$i", $movie);
        }

        $manager->flush();
    }
}
