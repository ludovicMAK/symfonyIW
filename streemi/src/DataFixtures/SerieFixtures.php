<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SerieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 5; $i < 10; $i++) {
            $serie = new Serie();
            $serie->setTitle("Serie $i");
            $serie->setShortDescription("Short description of serie $i");
            $serie->setLongDescription("Long description of serie $i");
            $serie->setReleaseDate(new \DateTime());
            $serie->setCoverImage("serie$i.jpg");
            $manager->persist($serie);

            // Ajout de la référence générique
            $this->addReference("media_$i", $serie);
        }

        $manager->flush();
    }
}
