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
use App\Model\SearchData;
use App\Form\SearchType;

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
        PageFromRequestService $pageFromRequestService
    ) {
        $this->searchTerm = $requestQueryService->get(self::SEARCH_FORM_NAME);
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
    }

    #[Route('/', name: 'index', methods: ['GET', 'POST'])]
    public function index(Request $request, ProductRepository $productRepository): Response
    {   
        /*if ($this->searchTerm) {
            return $this->search();
        }*/

        $products = $productRepository->findAllWithPage($this->page, self::LIMIT); 
        $paginatorHelper = new PaginatorHelper($this->page, count($products), self::LIMIT);
        
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid){
            dd($searchData);
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    private function search(): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid){
            dd($searchData);
        }
        //$paginatorHelper = new PaginatorHelper($this->page, count($products), self::LIMIT);

        return $this->render('product/index.html.twig', [
            'searchTerm' => $searchTerm,
            'products' => $products,
            //'paginatorHelper' => $paginatorHelper,
        ]);
    }
    
    #[Route('/new', name: 'new', methods: ['GET','POST'])]
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
    #[Security('product.getCompany() === user.getCompany()')]
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[Security('product.getCompany() === user.getCompany()')]
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
    public function deleteOne(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    }
}