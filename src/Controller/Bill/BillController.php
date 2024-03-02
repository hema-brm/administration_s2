<?php

namespace App\Controller\Bill;

use App\Controller\Quote;
use App\Entity\Bill;
use App\Form\BillType;
use App\Repository\BillRepository;
use App\Repository\UserRepository;
use App\Service\PdfService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/bill')]
class BillController extends AbstractController
{


    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function generateHtml(Quote $quote) : string {
    }


    #[Route('/pdf/{id}', name: 'facture_pdf')]
public function generatePdfFacture(Bill $bill, PdfService $pdf): Response
{
    // Récupération des informations nécessaires à partir de l'objet Bill
    $customerLastName = $bill->getCustomer()->getLastname();
    $customerFirstName = $bill->getCustomer()->getFirstname();
    $company = $bill->getCustomer()->getCompany();
    $discount = $bill->getDiscount();
    $status = $bill->getStatus();

    // Initialisation des variables pour les totaux
    $totalPriceSum = 0;
    $tvaAmount = 0;

    // Initialisation du contenu HTML de la facture
    $html = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Facture</title>
        <style>
            body {
                text-align: center;
                font-family: 'Times New Roman', Times, serif;
            }
            .invoice {
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                max-width: 800px; 
            }
            .invoice h2 {
                margin-bottom: 20px;
            }
            .invoice-details {
                text-align: left;
                margin-bottom: 20px;
            }
            .invoice-details p {
                margin: 5px 0;
            }
            .invoice-table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .invoice-table th, .invoice-table td {
                border: 1px solid #ddd;
                padding: 8px;
            }
            .invoice-table th:nth-child(1),
            .invoice-table td:nth-child(1) {
                width: 20%; 
            }
            .invoice-table th:nth-child(2),
            .invoice-table td:nth-child(2) {
                width: 20%; 
            }
            .invoice-table th:nth-child(3),
            .invoice-table td:nth-child(3) {
                width: 15%; 
            }
            .invoice-table th:nth-child(4),
            .invoice-table td:nth-child(4) {
                width: 20%; 
            }
            .invoice-table th:nth-child(5),
            .invoice-table td:nth-child(5) {
                width: 25%; 
            }
            .invoice-total {
                margin-top: 20px;
            }
            .invoice-total p {
                margin: 5px 0;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class='invoice'>
            <h2>Facture</h2>
            <div class='invoice-details'>
                <p>Client: <strong> $customerLastName $customerFirstName </strong></p>
                <p>Date: <strong> " . (new DateTime())->format('Y-m-d') . "</strong> </p>
                <p>Statut de la facture:<strong>  $status </strong> </p>
                <p style='text-align: center;'>----------------------------------------------------------------------------------------------------------------------------------</p>
                <p>Entreprise:<strong>  $company </strong> </p>
                <p>Réduction:<strong>  $discount % </strong> </p>
            </div>
            <table class='invoice-table'>
                <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>TVA</th>
                    <th>Remise</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>";

    // Initialisation du tableau des catégories
    $categories = [];

    // Regrouper les produits par catégorie
    foreach ($bill->getProductBills() as $productBill) {
        $product = $productBill->getProduct();
        $category = $product->getCategory(); // Récupérer la catégorie du produit

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
            'quantity' => $productBill->getQuantity(),
            'tva' => $productBill->getTva(),
            'tvaAmount' => $productBill->getTotalTVA(),
            'discount' => $productBill->getDiscount(),
            'discountAmount' => $productBill->getTotalDiscount(),
            'price' => $productBill->getPrice(),
            'totalPrice' => $productBill->getTotal(),
        ];

        // Mise à jour du total des prix
        $totalPriceSum += $product->getPrice() * $productBill->getQuantity();
    }

    // Générer le HTML de la facture en affichant chaque catégorie avec ses produits
    foreach ($categories as $categoryId => $category) {
        // Ajouter le nom de la catégorie au HTML de la facture
        $html .= "<tr>
                    <td style='text-align: center;' rowspan='" . count($category['products']) . "'>{$category['name']}</td>";

        // Ajouter les produits de la catégorie au HTML de la facture
        foreach ($category['products'] as $index => $product) {
            if ($index !== 0) {
                $html .= "<tr>";
            }

            $html .= "<td style='text-align: center;'>{$product['name']}</td>
                    <td style='text-align: center;'>{$product['quantity']}</td>
                    <td style='text-align: center;'>{$product['price']} €</td>
                    <td style='text-align: center;'>{$product['tva']}% ~ {$product['tvaAmount']}</td>
                    <td style='text-align: center;'>{$product['discount']}% ~ {$product['discountAmount']}</td>
                    <td style='text-align: center;'>{$product['totalPrice']} €</td>
                  </tr>";
        }
    }

    // Calcul du total avec TVA
    $total = $bill->getTotal();
    $totalDiscount = $bill->getTotalDiscount();
    $totalWithDiscount = $bill->getTotalWithDiscount();

    // Finalisation du HTML avec les totaux
    $html .= "</tbody>
            </table>
            <div class='invoice-total'>
                <p>Total: " . $total . " €</p>
                <p>Remise: " . $totalDiscount .  " €</p>
                <p>Total avec remise: " . $totalWithDiscount .  " €</p>
            </div>
        </div>
    </body>
    </html>";

    // Génération du PDF à partir du contenu HTML
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





    #[Route('/', name: 'app_bill_index', methods: ['GET'])]
    public function index(BillRepository $billRepository, UserRepository $userRepository): Response
    {
    $user = $this->getUser(); // Récupère l'utilisateur connecté
    $bills = [];

    // Vérifie si l'utilisateur est connecté
    if ($user) {
        // Récupère l'entreprise de l'utilisateur connecté
        $userCompany = $user->getCompany();

        // Si l'utilisateur appartient à une entreprise
        if ($userCompany) {
            // Récupère les factures de l'entreprise de l'utilisateur connecté
            $bills = $billRepository->findBy([]);
        }

    }

    return $this->render('bill/index.html.twig', [
        'bills' => $bills,
    ]);
    }




    #[Route('/new', name: 'app_bill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bill = new Bill();
        $form = $this->createForm(BillType::class, $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bill);
            $entityManager->flush();

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bill/new.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bill_show', methods: ['GET'])]
    public function show(Bill $bill): Response
    {
        return $this->render('bill/show.html.twig', [
            'bill' => $bill,
        ]);
    }




    #[Route('/{id}/edit', name: 'app_bill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bill $bill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BillType::class, $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bill/edit.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bill_delete', methods: ['POST'])]
    public function delete(Request $request, Bill $bill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);
    }
}
