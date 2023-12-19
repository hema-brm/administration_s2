<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Repository\CompanyRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    private $entrepriseRepository;
    // construct with faker
    public function __construct(CompanyRepository $entrepriseRepository)
    {
        $this->faker = Factory::create();
        $this->entrepriseRepository = $entrepriseRepository;
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

            $company = $this->entrepriseRepository->findOneBy(['name'=>'MarryMe']);
            $customer->setCompany($company);
            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CompanyFixtures::class
        ];
    }
}
