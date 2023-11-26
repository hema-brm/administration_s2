<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Entreprise;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        EntityManagerInterface $entityManager
    ): Response {
        $user = new User();
        $user->setRoles(['ROLE_ENTREPRISE']);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire User
            $userData = $form->getData();

            // Récupérer les données de l'entreprise à partir du formulaire
            $entrepriseNom = $form->get('Nom')->getData();
            $entrepriseAdresse = $form->get('Adresse')->getData();
            $entrepriseNumeroSiret = $form->get('Numero_Siret')->getData();

            // Créer une instance d'entreprise et lui attribuer les données du formulaire
            $entreprise = new Entreprise();
            $entreprise->setNom($entrepriseNom);
            $entreprise->setAdresse($entrepriseAdresse);
            $entreprise->setNumeroSiret($entrepriseNumeroSiret);

            // Enregistrer l'entreprise
            $entityManager->persist($entreprise);
            $entityManager->flush();

            // Enregistrer l'utilisateur et associer l'entreprise
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setEntreprise($entreprise);
            $firstName = $form->get('firstName')->getData();
            $user->setFirstName($firstName);
            $lastName = $form->get('lastName')->getData();
            $user->setLastName($lastName);
            $phoneNumber = $form->get('phoneNumber')->getData();
            $user->setPhoneNumber($phoneNumber);

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
