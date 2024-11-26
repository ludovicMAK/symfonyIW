<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $languages = [
            ['name' => 'English', 'code' => 'en'],
            ['name' => 'French', 'code' => 'fr'],
            ['name' => 'Spanish', 'code' => 'es'],
            ['name' => 'German', 'code' => 'de'],
            ['name' => 'Japanese', 'code' => 'ja'],
        ];

        foreach ($languages as $index => $data) {
            $language = new Language();
            $language->setName($data['name']);
            $language->setCode($data['code']);
            $manager->persist($language);

            // Add reference for other fixtures
            $this->addReference('language_' . $index, $language);
        }

        $manager->flush();
    }
}
