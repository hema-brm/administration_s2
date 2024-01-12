<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {   
        $this->addProducts($manager, AppFixtures::PRODUCT_COUNT);
        $manager->flush();
    }

    private function addProducts(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $category = $this->getReference(sprintf('category-%d', $this->faker->numberBetween(1, AppFixtures::CATEGORY_COUNT)));

            $product = new Product();
            $product
                ->setName("Product-$i: " . $this->faker->name())
                ->setReference($this->faker->ean13())
                ->setCategory($category)
                ->setPrice($this->faker->randomFloat(2, 10, 1000))
                ->setDescription($this->faker->paragraph)
            ;

            $company = $this->getReference(sprintf('company-%d', $this->faker->numberBetween(1, AppFixtures::COMPANY_COUNT)));
            $product->setCompany($company);
            $manager->persist($product);
            $this->addReference("product-$i", $product);
        }
    }

    public function getDependencies() : array
    {
        return [
            CompanyFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
