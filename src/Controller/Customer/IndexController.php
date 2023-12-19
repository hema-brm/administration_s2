<?php

namespace App\Controller\Customer;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/customer', name: 'app_customer_')]
#[IsGranted("manage")]
class IndexController extends AbstractController
{
    private ?string $searchTerm;
    private ?int $page;

    public const SEARCH_FORM_NAME = 'search';

    const PAGE_PARAM_NAME = 'page';
    const LIMIT = 10;

    public function __construct(
        RequestQueryService $requestQueryService,
        PageFromRequestService $pageFromRequestService
    ) {
        $this->searchTerm = $requestQueryService->get(self::SEARCH_FORM_NAME);
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CustomerRepository $customerRepository): Response
    {
        if ($this->searchTerm) {
            return $this->search($this->searchTerm, $customerRepository);
        }

        $customers = $customerRepository->findAllWithPage($this->page, self::LIMIT); 
        $paginatorHelper = new PaginatorHelper($this->page, count($customers), self::LIMIT);

        return $this->render('@customer/index/index.html.twig', [
            'customers' => $customers,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    private function search(string $searchTerm, CustomerRepository $customerRepository): Response
    {
        $customers =  $customerRepository->search($searchTerm, $this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($customers), self::LIMIT);

        return $this->render('@customer/index/index.html.twig', [
            'searchTerm' => $searchTerm,
            'customers' => $customers,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();

            $this->addFlash('success', "Le client a été enregistré.");
            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        // If form is not valid when submitted, display error message
        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('info', "Veuillez corriger les informations saisies.");
            $this->addFlash('error', "Le client n'a pas été enregistré.");
        }

        return $this->render('@customer/index/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Customer $customer): Response
    {
        return $this->render('@customer/index/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Customer $customer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "Le client a bien été modifié.");
            return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash('info', "Veuillez corriger les informations saisies.");
            $this->addFlash('error', "Le client n'a pas été modifié.");
        }

        return $this->render('@customer/index/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Customer $customer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($customer);
            $entityManager->flush();

            $this->addFlash('success', "Le client a bien été supprimé.");
        } else {
            $this->addFlash('info', "Le client n'a pas été supprimé.");
            $this->addFlash('error', "Oups, une erreur est survenue.");
        }

        return $this->redirectToRoute('app_customer_index', [], Response::HTTP_SEE_OTHER);
    }

}
