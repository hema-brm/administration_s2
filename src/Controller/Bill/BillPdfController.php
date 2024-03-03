<?php

namespace App\Controller\Bill;

use App\Entity\Bill;
use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pdf/quote', name: 'app_bill_pdf_')]
class BillPdfController extends AbstractController
{
    public function generateHtml(Bill $bill) : string{

        $categories = [];

        foreach ($bill->getProductBills() as $productBill) {
            $product = $productBill->getProduct();
            $category = $product->getCategory();
            $categories[$category->getId()][] = [
                'name' => $category->getName(),
                'product' => $product->getName(),
                'quantity' => $productBill->getQuantity(),
                'price' => $productBill->getPrice(),
                'tva' => $productBill->getTva(),
                'tvaAmount' => $productBill->getTotalTva(),
                'discount' => $productBill->getDiscount(),
                'discountAmount' => $productBill->getTotalDiscount(),
                'total' => $productBill->getTotal(),
            ];
        }

        $html = $this->renderView('bill/document/bill.html.twig', [
            'bill' => $bill,
            'categories' => $categories,
        ]);

        return $html;
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function index(Bill $bill, PdfService $pdf): Response
    {
        $html = $this->generateHtml($bill);
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