<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        $product = new Product();
        return $this->render('product/index.html.twig', [
            'product' => $product,
            
        ]);
    }



        //pk pas delete ?
     #[Route('/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request,Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product', [], Response::HTTP_SEE_OTHER);
    }
}
