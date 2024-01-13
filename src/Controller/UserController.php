<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\AddUserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/employee')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_employee_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        // Récupérer l'entreprise de l'utilisateur connecté
        $company = $security->getUser()->getCompany();

        $form = $this->createForm(AddUserFormType::class, $user, ['company' => $company]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: 'app_employee_deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $employees = $request->request->all()['employees'];
        foreach($employees as $id => $token){
            $employee = $userRepository->find($id);
            if($employee){
                if ($this->isCsrfTokenValid('delete'.$id, $token)) {
                    $entityManager->remove($employee);
                }
            }
        }
        $entityManager->flush(); 
        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_employee_delete', methods: ['POST'])]
    public function deleteOne(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }

}
