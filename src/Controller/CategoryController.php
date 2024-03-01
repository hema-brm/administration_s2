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
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/products/category', name: 'app_category_')]
class CategoryController extends AbstractController
{
    public function __construct(Security $security){
        $this->isAdmin = $security->isGranted('ROLE_ADMIN');
        $this->isGTCompany = $security->isGranted('ROLE_ENTREPRISE');

    }
    #[Route('/', name: 'index', methods: ['GET'])]
    #[IsGranted('view')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        if($this->isAdmin){
            $categories = $categoryRepository->findBy( [],['company' => 'ASC']);
        }else{
            $categories = $categoryRepository->findBy(['company' => $this->getUser()->getCompany()]);
        }

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'showCompany' => $this->isAdmin,
            'isGTCompany' => $this->isGTCompany,

        ]);
    }

     #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
     #[IsGranted('add')]
     public function new(Request $request, EntityManagerInterface $entityManager): Response
     {
         $category = new Category("");
         $form = $this->createForm(CategoryType::class, $category);
         $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
    $category->setCompany($this->getUser()->getCompany());
    $entityManager->persist($category);
    $entityManager->flush();

    return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('category/new.html.twig', [
    'category' => $category,
    'form' => $form,
    ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    // #[IsGranted('read', 'category')]
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

    #[Route('/delete', name: 'deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        $categories = $request->request->all()['categories'];
        $count = 0;
        foreach($categories as $id => $token){
            $category = $categoryRepository->find($id);
            if($category && $this->isCsrfTokenValid('delete'.$id, $token)){
                $entityManager->remove($category);
                $count++;
            }
        }
        $this->addFlash('success', $count.' catégorie(s) supprimé(s) avec succès.');
        $entityManager->flush();
        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    // #[IsGranted('delete', 'category')]
    public function deleteOne(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }
}