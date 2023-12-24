<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AddUserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserControllerOld extends AbstractController
{
    #[Route('/add_user', name: 'add_user')]
    public function addUser(Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        // Récupérer l'entreprise de l'utilisateur connecté
        $company = $security->getUser()->getCompany();

        $form = $this->createForm(AddUserFormType::class, $user, ['company' => $company]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('add_user'); 
        }

        return $this->render('user/add.html.twig', [
            'form' => $form,
        ]);
    }
}
