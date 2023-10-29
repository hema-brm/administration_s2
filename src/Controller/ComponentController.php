<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/doc/components', name: 'app_doc_component_')]
class ComponentController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('guidelines/index.html.twig', [
            'components' => $this->getComponentList(),
        ]);
    }

    #[Route('/{component}', name: 'show')]
    public function show(string $component): Response
    {
        try {
            return $this->render('guidelines/' . $component . '/index.html.twig');
        } catch (\Exception $e) {
            throw $this->createNotFoundException(
                "Cannot find component guideline: templates/guidelines/$component.html.twig "
            );
        }
    }

    private function getComponentList()
    {
        return [
            "container",
        ];
    }
}
