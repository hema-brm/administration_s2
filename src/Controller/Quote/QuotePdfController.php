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
        $tva = $quote->getTva();

        // Regrouper les produits par catégorie
        foreach ($quote->getProductQuotes() as $productQuote) {

            $product = $productQuote->getProduct();
            $category = $product->getCategory(); // Récupérer la catégorie du produit
            $totalPriceSum = 0;
            $discount = $quote->getDiscount();

            // Ajouter la catégorie au tableau des catégories si elle n'existe pas déjà
            if (!isset($categories[$category->getId()])) {
                $categories[$category->getId()] = [
                    'name' => $category->getName(),
                    'products' => []
                ];
            }
            // Ajouter le produit à la catégorie correspondante
            $categories[$category->getId()]['products'][] = [
                'name' => $product->getName(),
                'quantity' => $productQuote->getQuantity(),
                'price' => $product->getPrice(),
                'totalPrice' => $product->getPrice() * $productQuote->getQuantity(),
            ];

            // Mise à jour du total des prix
            $totalPriceSum += $product->getPrice() * $productQuote->getQuantity();
        }

        $tvaAmount = 0;
        if ($tva) {
            $tvaAmount = $totalPriceSum * ($tva / 100);
        }

        $totalWithTva = $totalPriceSum + $tvaAmount;

        // Calcul du total avec remise si elle existe
        if ($discount) {
            $discountAmount = $totalWithTva * ($discount / 100); // Calcul du montant de la remise
            $totalWithDiscount = $totalWithTva - $discountAmount; // Calcul du total avec remise
        } else {
            $totalWithDiscount = $totalWithTva; // Si pas de remise, le total avec remise est le même que le total avec TVA
        }

        $html = $this->renderView('quote/document/quote.html.twig', [
            'quote' => $quote,
            'categories' => $categories,
            'totalPriceSum' => $totalPriceSum,
            'totalWithTva' => $totalWithTva,
            'totalWithDiscount' => $totalWithDiscount

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