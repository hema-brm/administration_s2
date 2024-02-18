<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Form\PaymentType;
use App\Form\PaymentEditType;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/payment', name: 'app_payment_')]
class PaymentController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PaymentRepository $paymentRepository): Response
    {
        return $this->render('payment/index.html.twig', [
            'payments' => $paymentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Perform additional validation to check if client name and invoice number exist in Bill table
            $selectedBill = $form->get('bill')->getData();

            // If validation passes, proceed to save the payment
            $payment->setBill($selectedBill);
            
            $entityManager->persist($payment);
            $entityManager->flush();

            $this->addFlash('success', 'Payment created successfully.');

            return $this->redirectToRoute('app_payment_index');
        }

        return $this->render('payment/new.html.twig', [
            'payment' => $payment,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Payment $payment): Response
    {
        return $this->render('payment/show.html.twig', [
            'payment' => $payment,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Payment $payment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaymentEditType::class, $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Payment updated successfully.');

            return $this->redirectToRoute('app_payment_index');
        }

        return $this->render('payment/edit.html.twig', [
            'payment' => $payment,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete', name: 'deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, PaymentRepository $paymentRepository, EntityManagerInterface $entityManager): Response
    {
        $payments = $request->request->all()['payments'];
        $count = 0;
        foreach($payments as $id => $token){
            $payment = $paymentRepository->find($id);
            if($payment && $this->isCsrfTokenValid('delete'.$id, $token)){
                $entityManager->remove($payment);
                $count++;
            }
        }
        $this->addFlash('success', $count.' suivi(s) de paiement(s) supprimé(s) avec succès.');
        $entityManager->flush();
        return $this->redirectToRoute('app_payment_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Payment $payment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($payment);
            $entityManager->flush();

            $this->addFlash('success', 'Payment deleted successfully.');
        }

        return $this->redirectToRoute('app_payment_index');
    }
}
