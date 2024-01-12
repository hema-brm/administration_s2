<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Twig\Helper\Paginator\PaginatorHelper;

#[Route('/products')]
class ProductController extends AbstractController
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

    #[Route('/', name: 'app_product_index', methods: ['GET', 'POST'])]
    public function index(Request $request, ProductRepository $productRepository): Response
    {   
        if ($this->searchTerm) {
            return $this->search($this->searchTerm, $productRepository);
        }

        $products = $productRepository->findAllWithPage($this->page, self::LIMIT); 
        $paginatorHelper = new PaginatorHelper($this->page, count($products), self::LIMIT);

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    private function search(string $searchTerm, ProductRepository $productRepository): Response
    {
        $products =  $productRepository->search($searchTerm, $this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($products), self::LIMIT);

        return $this->render('product/index.html.twig', [
            'searchTerm' => $searchTerm,
            'products' => $products,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }
    
    #[Route('/new', name: 'app_product_new', methods: ['GET','POST'])]
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

    
    #[Route('/delete', name: 'app_product_deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $productDatasJSON = $request->getContent();
        $productDatas = json_decode($productDatasJSON, true);
        foreach($productDatas as $productData){
            $id = $productData['id'];
            $token = $productData['token'];
            $product = $productRepository->find($id);
            if($product){
                if ($this->isCsrfTokenValid('delete'.$id, $token)) {
                    $entityManager->remove($product);
                }
            }
        }
        
        $entityManager->flush();
        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);

    }


    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    #[Security('product.getCompanyId() === user.getCompany()')]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    #[Security('product.getCompanyId() === user.getCompany()')]
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

}