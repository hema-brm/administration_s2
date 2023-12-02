<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {   /*
        $faker = \Faker\Factory::create('fr_FR');
        $pwd = 'test';

        $users =  [
            [
                'entreprise_id' => '1',
                'first_name' =>'Admin',
                'last_name' => 'Test',
                'phone_number' => '0102030405',
                'email' => 'admin@user.fr',
                'roles' => ['ROLE_ADMIN'],
                'reference' => 'admin'
            ],
            [
                'entreprise_id' => '3',
                'first_name' =>'Entreprise',
                'last_name' => 'Test',
                'phone_number' => '0101020203',
                'email' => 'entreprise@user.fr',
                'roles' => ['ROLE_ENTREPRISE'],
                'reference' => 'entreprise'
            ],
            [
                'entreprise_id' => '3',
                'first_name' =>'Employee',
                'last_name' => 'Test',
                'phone_number' => '0645342345',
                'email' => 'employee@user.fr',
                'roles' => ['ROLE_EMPLOYEE'],
                'reference' => 'employee'
            ]
        ];

        foreach ($users as $user) {
            $object = (new User())
                ->setEntreprise($user['entreprise_id'])
                ->setFirstName($user['first_name'])
                ->setLastName($user['last_name'])
                ->setPhoneNumber($user['phone_number'])
                ->setEmail($user['email'])
                ->setRoles($user['roles'])
            ;
            $object->setPassword($this->passwordHasher->hashPassword($object, $pwd));
            $manager->persist($object);
            $this->addReference($user['reference'], $object);
        }
        
        for ($i = 0; $i < 10; $i++) {
            $user = (new User())
                ->setEntreprise(1)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setPhoneNumber($faker->phoneNumber)
                ->setEmail($faker->email)
                ->setRoles([])
            ;
            $user->setPassword($this->passwordHasher->hashPassword($user, $pwd));
            $manager->persist($user);
        }*/

        $manager->flush();
    }
}
