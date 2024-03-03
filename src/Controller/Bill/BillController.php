<?php

namespace App\Controller\Bill;

use App\Service\Bill\AccessibleBillService;
use DateTime;
use App\Entity\Bill;
use App\Form\BillType;
use App\Service\PdfService;
use App\Repository\BillRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/bill', name: 'app_bill_')]
class BillController extends AbstractController
{


    private $kernel;

    public function __construct(KernelInterface $kernel, Security $security)
    {
        $this->kernel = $kernel;
        $this->isAdmin = $security->isGranted('ROLE_ADMIN');
        $this->isGTEmployee = $security->isGranted('ROLE_EMPLOYEE');
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    #[IsGranted('view')]
    public function index(AccessibleBillService $accessibleBillService): Response
    {
        $bills = $accessibleBillService->findAll();

        return $this->render('bill/index.html.twig', [
            'bills' => $bills,
            'showCompany' => $this->isAdmin,
            'isGTEmployee' => $this->isGTEmployee
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    #[IsGranted('add')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bill = new Bill();
        $form = $this->createForm(BillType::class, $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bill);
            $entityManager->flush();

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bill/new.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }

    #[Route('/delete', name: 'deleteAll', methods: ['POST'])]
    #[IsGranted('add')]
    public function deleteMany(Request $request, BillRepository $billRepository, EntityManagerInterface $entityManager): Response
    {
        $bills = $request->request->all()['bills'];
        $count = 0;
        foreach($bills as $id => $token){
            $bill = $billRepository->find($id);
            if($bill && $this->isCsrfTokenValid('delete'.$id, $token)){
                $entityManager->remove($bill);
                $count++;
            }
        }
        $this->addFlash('success', $count.' facture(s) supprimée(s) avec succès.');
        $entityManager->flush();
        return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    #[IsGranted('read', 'bill')]
    public function show(Bill $bill): Response
    {
        return $this->render('bill/show.html.twig', [
            'bill' => $bill,
        ]);
    }




    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[IsGranted('edit', 'bill')]
    public function edit(Request $request, Bill $bill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BillType::class, $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bill/edit.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    #[IsGranted('delete', 'bill')]
    public function delete(Request $request, Bill $bill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
    }
}
