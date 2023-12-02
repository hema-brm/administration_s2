<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Repository\UserRepository;

class CompanyFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {/*
        $faker = \Faker\Factory::create('fr_FR');

        function generateSIRET($faker) {
            $siret = $faker->randomNumber(9, true); // Génère un nombre aléatoire de 9 chiffres
        
            // Le numéro SIRET se compose du SIREN (9 premiers chiffres) suivi du numéro NIC (5 derniers chiffres)
            // Le NIC est composé d'un code établissement (3 chiffres) et d'un numéro d'ordre (2 chiffres)
            $siret .= sprintf("%05d", $faker->numberBetween(0, 99999)); // Génère les 5 derniers chiffres du SIRET
        
            return $siret;
        }
        $users = $userRepository ->findAll();
        //$lengthUsers = count($users);

        for ($i = 0; $i < 5; $i++) {
            $company = (new Entreprise())
                ->setNom($faker->company)
                ->setNumeroSiret(generateSIRET($faker))
                ->setAdresse($faker->adress)
                ->setEmail($faker->email);

                $owner = $users[$i]->getId();
                $company->addUserId($owner);
                $users[$i]->setRoles(['ROLE_ENTREPRISE']);
                $users[$i]->setEntreprise()
                //parmis les user cree jvais prendre 1 (aleatoire) et les mettre dans adduserid et changer leur role par la meme occas
            ;
            $manager->persist($company);


        }*/

        $manager->flush();
    }
}
