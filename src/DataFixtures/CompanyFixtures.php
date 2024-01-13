<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\UserRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;

class CompanyFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager): void
    {
        $this->addCompanies($manager, AppFixtures::COMPANY_COUNT);

        $manager->flush();
    }

    private function addCompanies(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $company = new Company();
            $company
                ->setName("Company-$i: " . $this->faker->name())
                ->setSiretNumber($this->faker->numberBetween(10000000000000, 99999999999999))
                ->setAdress($this->faker->address());

            $manager->persist($company);
            $this->addReference("company-$i", $company);
        }
    }
}
