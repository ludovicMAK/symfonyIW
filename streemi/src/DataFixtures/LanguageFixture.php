<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $languages = ['English', 'French', 'Spanish', 'German', 'Japanese'];

        foreach ($languages as $index => $name) {
            $language = new Language();
            $language->setName($name);
            $manager->persist($language);

            // Add reference for other fixtures
            $this->addReference('language_' . $index, $language);
        }

        $manager->flush();
    }
}
