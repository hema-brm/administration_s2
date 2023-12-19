<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\CompanyRepository;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    private $entrepriseRepository;
    
    public function __construct(CompanyRepository $entrepriseRepository)
    {
        $this->faker = Factory::create();
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function load(ObjectManager $manager): void
    {   
        $count = 100;
        $category = new Category('Art');
        $manager->persist($category);
        for ($i = 0; $i < $count; $i++) {
            $product = new Product();
            $product
            ->setName($this->faker->words(random_int(4,10),true))
            ->setReference($this->faker->ean13())
            ->setCategory($category)
            ->setPrice($this->faker->randomFloat(2, 10, 1000));
            
            $description = $this->faker->paragraph;

            if(strlen($description)>255){
                $description = mb_substr($description, 0, 255);
            }
            $product->setDescription($description);
            
            $company = $this->entrepriseRepository->findOneBy(['name'=>'MarryMe']);
            $product->setCompanyId($company);
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        // Spécifie les dépendances - ici, ProductFixtures dépend de CompanyFixtures
        return [
            CompanyFixtures::class,
        ];
    }
}
