<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends Fixture
{
    private $faker;
    // construct with faker
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        $count = 100;

        for ($i = 0; $i < $count; $i++) {
            $customer = new Customer();
            $customer->setFirstName($this->faker->firstName());
            $customer->setLastName($this->faker->lastName());
            $customer->setEmail($this->faker->email());
            $customer->setPhone($this->faker->phoneNumber());
            $customer->setAddress($this->faker->address());

            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}