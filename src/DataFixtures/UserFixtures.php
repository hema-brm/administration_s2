<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private Generator $faker;
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher) {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->addAdmin($manager);
        $this->addOwner($manager, AppFixtures::COMPANY_OWNER_COUNT);
        $manager->flush();
    }

    private function addAdmin(ObjectManager $manager): void
    {
        $user = (new User())
            ->setFirstName('Super')
            ->setLastName('Admin')
            ->setPhoneNumber('0102030405')
            ->setEmail('admin@easyvows.com')
            ->setRoles(['ROLE_ADMIN']);

        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));

        $manager->persist($user);
    }

    private function addOwner(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $user = (new User())
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName())
                ->setPhoneNumber($this->faker->phoneNumber())
                ->setEmail("owner-$i@gmail.com")
                ->setRoles(['ROLE_ENTREPRISE']);

            $user->setPassword($this->passwordHasher->hashPassword($user, "owner-$i"));
            $manager->persist($user);

            $this->addReference("owner-$i", $user);
        }
    }

}
