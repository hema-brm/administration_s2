<?php

namespace App\Controller\User\Employee;

use App\Entity\User;
use App\Form\User\Employee\EmployeeType;
use App\Form\User\UserType;
use App\Repository\UserRepository;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Service\User\Employee\AccessibleEmployeeService;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employee', name: 'app_employee_')]
class EmployeeController extends AbstractController
{
    private ?string $searchTerm;
    private ?int $page;
    const PAGE_PARAM_NAME = 'page';
    const LIMIT = 10;

    private bool $isAdmin = false;

    public function __construct(
        RequestQueryService $requestQueryService,
        PageFromRequestService $pageFromRequestService,
        Security $security
    ) {
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
        $this->isAdmin = $security->isGranted('ROLE_ADMIN');
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(AccessibleEmployeeService $service, Security $security): Response
    {
        $employees = $service->findAll($this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($employees), self::LIMIT);

        return $this->render('user/employee/index.html.twig', [
            'users' => $employees,
            'paginatorHelper' => $paginatorHelper,
            'showCompany' => $this->isAdmin,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $formType = EmployeeType::class;

        $options = [
            'is_admin' => $this->isAdmin,
            'mode' => EmployeeType::ADD,
        ];

        $form = $this->createForm($formType, $user, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'L`employé a été créé avec succès.');

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('error', 'Le formulaire contient des erreurs.');
        }

        return $this->render('user/employee/new.html.twig', [
            'user' => $user,
            'form' => $form,
            'needCompany' => $this->isAdmin,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/employee/show.html.twig', [
            'user' => $user,
            'needCompany' => $this->isAdmin,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $formType = EmployeeType::class;

        $options = [
            'is_admin' => $this->isAdmin,
            'mode' => EmployeeType::EDIT,
        ];

        $form = $this->createForm($formType, $user, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'L`employé a été modifié avec succès.');
            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/employee/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: 'deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $employees = $request->request->all()['employees'];
        $count = 0;
        foreach($employees as $id => $token){
            $employee = $userRepository->find($id);
            if($employee && $this->isCsrfTokenValid('delete'.$id, $token)){
                $entityManager->remove($employee);
                $count++;
            }
        }
        $this->addFlash('success', $count.' employé(s) supprimé(s) avec succès.');
        $entityManager->flush(); 
        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function deleteOne(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }

}
