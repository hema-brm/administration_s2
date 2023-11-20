<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountantController extends AbstractController
{
    /**
     * @Route("/accountant", name="accountant")
     */
    public function accountant(): Response
    {
        return $this->render('accountant/accountant.html.twig');
    }

    
}
