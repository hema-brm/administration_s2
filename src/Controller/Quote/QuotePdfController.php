<?php

namespace App\Controller\Quote;

use App\Entity\Quote;
use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pdf/quote', name: 'app_quote_pdf_')]
class QuotePdfController extends AbstractController
{
    private function generateHtml(Quote $quote) : string{

        $categories = [];

        foreach ($quote->getProductQuotes() as $productQuote) {
            $product = $productQuote->getProduct();
            $category = $product->getCategory();
            $categories[$category->getId()][] = [
                'name' => $category->getName(),
                'product' => $product->getName(),
                'quantity' => $productQuote->getQuantity(),
                'price' => $productQuote->getPrice(),
                'tva' => $productQuote->getTva(),
                'tvaAmount' => $productQuote->getTotalTva(),
                'discount' => $productQuote->getDiscount(),
                'discountAmount' => $productQuote->getTotalDiscount(),
                'total' => $productQuote->getTotal(),
            ];
        }

        $html = $this->renderView('quote/document/quote.html.twig', [
            'quote' => $quote,
            'categories' => $categories,
        ]);

        return $html;
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function index(Quote $quote, PdfService $pdf): Response
    {
        $html = $this->generateHtml($quote);
        // Générer le PDF à partir du contenu HTML
        $pdfContent = $pdf->generatePdfContent($html);
        // Retourner le PDF en tant que réponse HTTP
        return new Response(
            $pdfContent,
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="facture.pdf"'
            ]
        );
    }
}