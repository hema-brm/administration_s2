<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\Roles\IUserRole;
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
        $user->setRoles([
            IUserRole::ROLE_COMPANY,
        ]);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire User
            $userData = $form->getData();

            // Récupérer les données de l'company à partir du formulaire
            $companyName = $form->get('name')->getData();
            $companyAdress = $form->get('adress')->getData();
            $companySiretNumber = $form->get('siretNumber')->getData();

            // Créer une instance d'company et lui attribuer les données du formulaire
            $company = new Company();
            $company->setName($companyName);
            $company->setAdress($companyAdress);
            $company->setSiretNumber($companySiretNumber);

            // Enregistrer l'company
            $entityManager->persist($company);
            $entityManager->flush();

            // Enregistrer l'utilisateur et associer l'company
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setCompany($company);
            $firstName = $form->get('firstName')->getData();
            $user->setFirstName($firstName);
            $lastName = $form->get('lastName')->getData();
            $user->setLastName($lastName);
            $phoneNumber = $form->get('phoneNumber')->getData();
            $user->setPhoneNumber($phoneNumber);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre compte a bien été créé. Vous pouvez vous connecter.');

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
