<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products/category')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {

        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findBy(['company' => $this->getUser()->getCompany()]),
        ]);
    }

    #[Route('/delete', name: 'app_category_deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, categoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        $categoryDatasJSON = $request->getContent();
        $categoryDatas = json_decode($categoryDatasJSON, true);
        
        foreach($categoryDatas as $categoryData){
            $id = $categoryData['id'];
            $token = $categoryData['token'];
            $category = $categoryRepository->find($id);
            
            if($category){
                if ($this->isCsrfTokenValid('delete'.$id, $token)) {
                    $entityManager->remove($category);
                }
            } 
        }
        $entityManager->flush();
        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);

    }

     #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
     public function new(Request $request, EntityManagerInterface $entityManager): Response
     {
         $category = new Category("");
         $form = $this->createForm(CategoryType::class, $category);
         $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
    $category->setCompanyId($this->getUser()->getCompany());
    $entityManager->persist($category);
    $entityManager->flush();

    return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('category/new.html.twig', [
    'category' => $category,
    'form' => $form,
    ]);
    }

    #[Route('/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

  
}