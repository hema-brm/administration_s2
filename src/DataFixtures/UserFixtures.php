<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $this->addAdmin($manager);
        $this->addOwner($manager);
        $manager->flush();
    }

    private function addAdmin(ObjectManager $manager): void
    {
        $user = (new User())
            ->setFirstName('Admin')
            ->setLastName('Test')
            ->setPhoneNumber('0102030405')
            ->setEmail('admin@easyvows.com')
            ->setRoles(['ROLE_ADMIN']);

        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));

        $manager->persist($user);
    }

    private function addOwner(ObjectManager $manager): void
    {
        $user = (new User())
            ->setFirstName('Owner')
            ->setLastName('Test')
            ->setPhoneNumber('0621134354')
            ->setEmail('owner@gmail.com')
            ->setRoles(['ROLE_ENTREPRISE']);

        $user->setPassword($this->passwordHasher->hashPassword($user, 'owner'));

        $manager->persist($user);
    }

}
