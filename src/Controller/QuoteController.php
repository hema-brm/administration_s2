<?php

namespace App\Controller;

use App\Entity\Quote;

use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quote')]
class QuoteController extends AbstractController
{
    #[Route('/', name: 'app_quote_index', methods: ['GET'])]
    public function index(QuoteRepository $quoteRepository): Response
    {
        return $this->render('quote/index.html.twig', [
            'quote' => $quoteRepository->findAll(),
        ]);
    }

    
    
    

   
}
