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

#[Route('/employee', name:'old_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_employee_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        // Récupérer tous les utilisateurs
        $users = $userRepository->findAll();

        // Filtrer les utilisateurs pour inclure uniquement ceux avec le rôle ROLE_USER
        $filteredUsers = array_filter($users, function ($user) {
            $userRoles = $user->getRoles();

            // Vérifier si l'utilisateur a uniquement le rôle ROLE_USER
            if (in_array('ROLE_USER', $userRoles) && !in_array('ROLE_ADMIN', $userRoles)) {
                return true; // Inclure l'utilisateur
            }

            return false; // Exclure l'utilisateur
        });

        return $this->render('user/index.html.twig', [
            'users' => $filteredUsers,
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
        $EmployeesDatasJSON = $request->getContent();
        $employeeDatas = json_decode($EmployeesDatasJSON, true);

        foreach($employeeDatas as $employeeData){
            $id = $employeeData['id'];
            $token = $employeeData['token'];
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
