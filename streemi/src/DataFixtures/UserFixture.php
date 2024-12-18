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
        ['email' => 'user1@example.com', 'password' => 'password123', 'roles' => ['ROLE_USER'], 'username' => 'toto'],
        ['email' => 'admin@example.com', 'password' => 'admin123', 'roles' => ['ROLE_ADMIN'], 'username' => 'admin'],
        ['email' => 'ludovic93mak@gmail.com', 'password' => 'test1234', 'roles' => ['ROLE_USER'], 'username' => 'ludo'],
    ];

    foreach ($users as $index => $data) {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        
        // Set the account status to the UserAccountStatusEnum
        $user->setAccountStatus(UserAccountStatusEnum::VALID);

        // Assign the roles as an array
        $user->setRoles($data['roles']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $manager->persist($user);

        $this->addReference('user_' . $index, $user);
    }

    $manager->flush();
}

}
