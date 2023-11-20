<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BusinessController extends AbstractController
{
    /**
     * @Route("/business", name="business")
     */
    public function index(): Response
    {
        return $this->render('business/business.html.twig');
    }

    /**
     * @Route("/payement", name="payement")
     */
    public function payement(): Response
    {
        return $this->render('business/payement.html.twig');
    }
}
