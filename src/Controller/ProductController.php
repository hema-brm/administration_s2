<?php

namespace App\Controller;

use App\DTO\SearchDto;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use App\Service\Request\RequestQueryService;
use Symfony\Component\HttpFoundation\Request;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Request\PageFromRequestService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/products', name: 'app_product_')]
class ProductController extends AbstractController
{
    private ?string $searchTerm;
    private ?int $page;

    public const SEARCH_FORM_NAME = 'search';

    const PAGE_PARAM_NAME = 'page';
    const LIMIT = 10;

    public function __construct(
        RequestQueryService $requestQueryService,
        PageFromRequestService $pageFromRequestService,
        Security $security,
    ) {
        $this->searchTerm = $requestQueryService->get(self::SEARCH_FORM_NAME);
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
        $this->isAdmin = $security->isGranted('ROLE_ADMIN');
        $this->isGTCompany = $security->isGranted('ROLE_ENTREPRISE');

    }

    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    #[IsGranted('view')]
    public function index(Request $request, ProductRepository $productRepository,#[MapQueryString()] SearchDto $searchDto = null): Response
    {   
        $products = $productRepository->_search($searchDto, $this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, $products['totalResults'], self::LIMIT);
        
        return $this->render('product/index.html.twig', [
            'products' => $products['results'],
            'paginatorHelper' => $paginatorHelper,
            'showCompany' => $this->isAdmin,
            'isGTCompany' => $this->isGTCompany,
            'searchDto' => $searchDto,
            'searchTerm' => $this->searchTerm
        ]);
    }

    
    #[Route('/new', name: 'new', methods: ['GET','POST'])]
    #[IsGranted('add')]
    public function new(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCompany($this->getUser()->getCompany());
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', "Le produit a bien été enregistré.");
            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[IsGranted('read', 'product')]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'isGTCompany' => $this->isGTCompany,
            'showCompany' => $this->isAdmin
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[IsGranted('edit', 'product')]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: 'deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $products = $request->request->all()['products'];
        $count = 0;
        foreach($products as $id => $token){
            $product = $productRepository->find($id);
            if($product && $this->isCsrfTokenValid('delete'.$id, $token)){
                $entityManager->remove($product);
                $count++;
            }
        }
        $this->addFlash('success', $count.' produit(s) supprimé(s) avec succès.');
        $entityManager->flush();
        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    #[IsGranted('delete', 'product')]
    public function deleteOne(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }
}