<?php

namespace App\Controller;

use App\Repository\BillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LiveTestController extends AbstractController
{
    #[Route('/live/test', name: 'live_test')]
    public function admin(BillRepository $billRepository): Response
    {
        $invoice = $billRepository->find(1);
        return $this->render('live/index.html.twig', [
            'invoice' => $invoice,
        ]);
    }
}
