<?php

namespace App\Controller;

use App\Entity\Bill;

use App\Repository\BillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bill')]
class BillController extends AbstractController
{
    #[Route('/', name: 'app_bill_index', methods: ['GET'])]
    public function index(BillRepository $billRepository): Response
    {
        return $this->render('bill/index.html.twig', [
            'bill' => $billRepository->findAll(),
        ]);
    }

    
    
    

   
}
