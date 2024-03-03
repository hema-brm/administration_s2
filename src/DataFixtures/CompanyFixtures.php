<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use App\Repository\UserRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;

class CompanyFixtures extends Fixture implements FixtureGroupInterface
{
    private Generator $faker;

    public function __construct(){
        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager): void
    {
        $this->addDefaultCompany($manager);
        $this->addCompanies($manager, AppFixtures::COMPANY_COUNT);

        $manager->flush();
    }

    public function addDefaultCompany(ObjectManager $manager): void
    {
        $company = new Company();
        $company
            ->setId(0)
            ->setName("Company-0: " . $this->faker->name())
            ->setSiretNumber($this->faker->numberBetween(10000000000000, 99999999999999))
            ->setAddress($this->faker->address());

        $this->addReference("company-0", $company);

        $manager->persist($company);
    }

    private function addCompanies(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $company = new Company();
            $company
                ->setName("Company-$i: " . $this->faker->name())
                ->setSiretNumber($this->faker->numberBetween(10000000000000, 99999999999999))
                ->setAddress($this->faker->address());

            $manager->persist($company);
            $this->addReference("company-$i", $company);
        }
    }

    public static function getGroups(): array
    {
        return [
            'company',
        ];
    }
}
