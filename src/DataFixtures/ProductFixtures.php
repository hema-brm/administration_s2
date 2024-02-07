<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;


class ProductFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    private $faker;
    private $categoryRepository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->faker = Factory::create();
        $this->categoryRepository = $entityManager->getRepository(Category::class);
    }

    public function load(ObjectManager $manager): void
    {   
        $this->addProducts($manager, AppFixtures::PRODUCT_COUNT);
        $manager->flush();
    }

    private function addProducts(ObjectManager $manager, int $count = 1): void
    {
        for ($i = 1; $i <= $count; $i++) {

            $product = new Product();
            $product
                ->setName("Product-$i: " . $this->faker->name())
                ->setReference($this->faker->ean13())
                ->setPrice($this->faker->randomFloat(2, 10, 1000));

                $description = $this->faker->paragraph;
                if(strlen($description)>150){
                    $description= substr($description, 0, 150);
                }
                $product->setDescription($description);

            $company = $this->getReference(sprintf('company-%d', $this->faker->numberBetween(1, AppFixtures::COMPANY_COUNT)));            $categories = $company->getCategories();
            $randomCategoryIndex = rand(0, count($categories)-1);
            $categories = $company->getCategories();
            
            $product->setCompany($company)
                    ->setCategory($categories[$randomCategoryIndex]);

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

    public static function getGroups(): array
    {
        return [
            'product',
        ];
    }
}
