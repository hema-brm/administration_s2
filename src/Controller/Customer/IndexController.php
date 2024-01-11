<?php

namespace App\Controller\Customer;

use App\Entity\Customer;
use App\Form\CrudSearchType;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\UX\Turbo\TurboBundle;

#[Route('/customer', name: 'app_customer_')]
class IndexController extends AbstractController
{
    private ?string $searchTerm;
    private ?int $page;

    public const SEARCH_FORM_NAME = 'crud_search';

    const PAGE_PARAM_NAME = 'page';
    const LIMIT = 10;

    public function __construct(
        RequestQueryService $requestQueryService,
        PageFromRequestService $pageFromRequestService
    ) {
        $searchQuery = $requestQueryService->all(self::SEARCH_FORM_NAME);
        $this->searchTerm = $searchQuery['search'] ?? null;
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(CustomerRepository $customerRepository): Response
    {
        if (!empty($this->searchTerm)) {
            return $this->search($this->searchTerm, $customerRepository);
        }

        $customers = $customerRepository->findAllWithPage($this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($customers), self::LIMIT);

        return $this->render('@customer/index/index.html.twig', [
            'searchForm' => $this->getSearchForm(),
            'customers' => $customers,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    private function search(string $searchTerm, CustomerRepository $customerRepository): Response
    {
        $customers =  $customerRepository->search($searchTerm, $this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($customers), self::LIMIT);

        $form = $this->getSearchForm();

        return $this->render('@customer/index/index.html.twig', [
            'searchForm' => $form,
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

        // get referer query params
        $referer = $request->headers->get('referer');
        $refererQuery = parse_url($referer, PHP_URL_QUERY);
        parse_str($refererQuery, $refererQueryParams);

        return $this->redirectToRoute('app_customer_index', $refererQueryParams, Response::HTTP_SEE_OTHER);
    }

    private function getSearchForm(): FormInterface
    {
        $search = !empty($this->searchTerm)
            ? $this->searchTerm
            : '';

        $data = [
            'search' => $search,
        ];

        return $this
            ->createForm(CrudSearchType::class, $data, [
                'action' => $this->generateUrl('app_customer_index'),
            ]);
    }

}
