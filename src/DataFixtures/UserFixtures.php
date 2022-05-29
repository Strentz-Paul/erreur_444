<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends AbstractBaseFixtures
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = self::faker();
        $user = new User();
        $user->setEmail($faker->email)
            ->setRoles(["ROLE_ADMIN"])
            ->setDisplayName($faker->userName);
        $password = $this->hasher->hashPassword($user, 'aze');
        $user->setPassword($password);
        $manager->persist($user);
        $manager->flush();
        $this->addReference(self::USER_REF, $user);
    }
}
