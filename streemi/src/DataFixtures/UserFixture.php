<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{


    public function load(ObjectManager $manager): void
    {
        $users = [
            ['email' => 'user1@example.com', 'password' => 'password123', 'roles' =>UserAccountStatusEnum::VALID, 'username'=>'toto' ],
            ['email' => 'admin@example.com', 'password' => 'admin123', 'roles' => UserAccountStatusEnum::VALID, 'username'=>'admin'],
        ];

        foreach ($users as $index => $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setAccountStatus($data['roles']);
            $user->setUsername($data['username']);
            $user->setPassword("test1234");
            $manager->persist($user);

            $this->addReference('user_' . $index, $user);
        }

        $manager->flush();
    }
}
