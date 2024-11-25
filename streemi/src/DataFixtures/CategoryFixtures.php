<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'category-';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            ['name' => 'Action', 'label' => 'Action'],
            ['name' => 'Drama', 'label' => 'Drama'],
            ['name' => 'Comedy', 'label' => 'Comedy'],
        ];

        foreach ($categories as $index => $data) {
            $category = new Category();
            $category->setName($data['name']);
            $category->setLabel($data['label']);

            $manager->persist($category);

            // Add a reference for related fixtures
            $this->addReference(self::CATEGORY_REFERENCE . $index, $category);
        }

        $manager->flush();
    }
}
