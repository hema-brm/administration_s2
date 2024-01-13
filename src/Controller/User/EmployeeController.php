<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\AddUserFormType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Service\User\Employee\AccessibleEmployeeService;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/employee', name: 'app_employee_')]
class EmployeeController extends AbstractController
{
    private ?string $searchTerm;
    private ?int $page;
    const PAGE_PARAM_NAME = 'page';
    const LIMIT = 10;

    public function __construct(
        RequestQueryService $requestQueryService,
        PageFromRequestService $pageFromRequestService
    ) {
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(AccessibleEmployeeService $service): Response
    {
        $employees = $service->findAll($this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($employees), self::LIMIT);

        return $this->render('user/employee/index.html.twig', [
            'users' => $employees,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
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

        return $this->render('user/employee/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/employee/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

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
