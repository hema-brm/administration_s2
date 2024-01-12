<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct() {
        $this->faker = Factory::create();
    }
    public function load(ObjectManager $manager): void
    {
        $this->addCategories($manager, AppFixtures::CATEGORY_COUNT);

        $manager->flush();
    }

    private function addCategories(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $category = new Category("Category-$i: " . $this->faker->name());
            $company = $this->getReference(sprintf('company-%d', $this->faker->numberBetween(1, AppFixtures::COMPANY_COUNT)));
            $category->setCompany($company);
            $manager->persist($category);
            $this->addReference("category-$i", $category);
        }
    }

    public function getDependencies() : array
    {
        return [
            CompanyFixtures::class,
        ];
    }

}
