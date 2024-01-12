<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\UserRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;

class CompanyFixtures extends Fixture implements DependentFixtureInterface
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

            $owner = $this->getReference(sprintf('owner-%d', $this->faker->numberBetween(1, AppFixtures::COMPANY_OWNER_COUNT)));
            $company->addUserId($owner);

            $this->addReference("company-$i", $company);
            $manager->persist($company);
        }

    }

    public function getDependencies() : array
    {
        return [
            UserFixtures::class,
        ];
    }
}
