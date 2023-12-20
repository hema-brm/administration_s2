<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\UserRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CompanyFixtures extends Fixture implements DependentFixtureInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    public function load(ObjectManager $manager): void
    {
        $company = new Company();
        $company
            ->setName("MarryMe")
            ->setSiretNumber("12321123212432")
            ->setAdress("11 avenue du grand moulin, 75002 Paris");

        $owner = $this->userRepository->findOneBy(['email' => 'owner@gmail.com']);

        $company->addUserId($owner);

        $this->addReference('company', $company);
        
        $manager->persist($company);
        $manager->flush();

    }

    public function getDependencies() : array
    {
        // Spécifie les dépendances - ici, CompanyFixtures dépend de UserFixtures
        return [
            UserFixtures::class,
        ];
    }
    
}
