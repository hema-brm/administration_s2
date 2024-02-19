<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Repository\CompanyRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Generator;


class CustomerFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    private Generator $faker;
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $this->addCustomers($manager, AppFixtures::CUSTOMER_COUNT);

        $manager->flush();
    }

    private function addCustomers(ObjectManager $manager, int $count = 1): void
    {

        for ($i = 1; $i <= $count; $i++) {
            $customer = new Customer();
            $customer->setFirstName($this->faker->firstName());
            $customer->setLastName($this->faker->lastName());
            $customer->setEmail($this->faker->email());
            $customer->setPhone($this->faker->regexify('/^(\+\d{2,3})?0\d{1}\d{2}\d{2}\d{2}\d{2}$/'));
            $customer->setAddress($this->faker->address());

            $company = $this->getReference(sprintf('company-%d', $this->faker->numberBetween(1, AppFixtures::COMPANY_COUNT)));
            $customer->setCompany($company);
            $manager->persist($customer);
        }
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CompanyFixtures::class
        ];
    }

    public static function getGroups(): array
    {
        return [
            'customer',
        ];
    }
}
