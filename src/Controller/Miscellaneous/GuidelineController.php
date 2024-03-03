<?php

namespace App\Controller\Miscellaneous;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GuidelineController extends AbstractController
{
    #[Route('/dev/guideline', name: 'app_guideline')]
    public function index(): Response
    {
        return $this->render('@guideline/index.html.twig', [
            'controller_name' => 'GuidelineController',
        ]);
    }
}
