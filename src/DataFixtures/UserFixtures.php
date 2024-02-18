<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    private Generator $faker;
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher) {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->addAdmin($manager);
        $this->addOwner($manager, AppFixtures::COMPANY_OWNER_COUNT);
        $this->addEmployee($manager, AppFixtures::EMPLOYEE_COUNT);
        $manager->flush();
    }

    private function addAdmin(ObjectManager $manager): void
    {
        $company = $this->getReference('company-0');
        $user = (new User())
            ->setFirstName('Super')
            ->setLastName('Admin')
            ->setPhoneNumber('0102030405')
            ->setEmail('admin@easyvows.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setCompany($company);
        ;

        $company->addUser($user);

        $user->setPassword('admin');

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

            $user->setPassword("owner-$i");

            $company = $this->getReference(sprintf('company-%d', $this->faker->numberBetween(1, AppFixtures::COMPANY_COUNT)));
            $company->addUser($user);

            $manager->persist($user);

            $this->addReference("owner-$i", $user);
        }
    }

    private function addEmployee(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $user = (new User())
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName())
                ->setPhoneNumber($this->faker->regexify('/^(\+\d{2,3})?0\d{1}\d{2}\d{2}\d{2}\d{2}$/'))
                ->setEmail("employee-$i@gmail.com")
                ->setRoles(['ROLE_EMPLOYEE']);

            $user->setPassword("employee-$i");

            $company = $this->getReference(sprintf('company-%d', rand(1, AppFixtures::COMPANY_COUNT)));
            $user->setCompany($company);

            $manager->persist($user);
            $this->addReference("employee-$i", $user);
        }
    }
    public function getDependencies() : array
    {
        return [
            CompanyFixtures::class,
        ];
    }

    public static function getGroups(): array
    {
        return [
            'company',
            'user',
        ];
    }
}
