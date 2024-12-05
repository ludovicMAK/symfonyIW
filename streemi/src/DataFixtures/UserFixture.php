<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ['email' => 'user1@example.com', 'password' => 'password123', 'roles' => UserAccountStatusEnum::VALID, 'username' => 'toto'],
            ['email' => 'admin@example.com', 'password' => 'admin123', 'roles' => UserAccountStatusEnum::VALID, 'username' => 'admin'],
        ];

        foreach ($users as $index => $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setAccountStatus($data['roles']);
            $user->setUsername($data['username']);
            $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
            $user->setPassword($hashedPassword);
            $manager->persist($user);

            $this->addReference('user_' . $index, $user);
        }

        $manager->flush();
    }
}
