<?php
//QuoteController.php
namespace App\Controller;

use App\Entity\Quote;
use App\Entity\Bill;
use App\Entity\ProductBill;
use App\Form\QuoteType;
use App\Repository\QuoteRepository;
use App\Repository\BillRepository;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProductQuote;
use App\Service\PdfService;
use Dompdf\Dompdf;
use DateTime;
use App\Controller\MailerController;

#[Route('/quote', name: 'app_quote_')]
class QuoteController extends AbstractController
{
    private ?string $searchTerm;
    private ?int $page;

    public const SEARCH_FORM_NAME = 'search';

    const PAGE_PARAM_NAME = 'page';
    const LIMIT = 10;

    public function __construct(
        RequestQueryService $requestQueryService,
        PageFromRequestService $pageFromRequestService
    ) {
        $this->searchTerm = $requestQueryService->get(self::SEARCH_FORM_NAME);
        $this->page = $pageFromRequestService->get(self::PAGE_PARAM_NAME);
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(QuoteRepository $quoteRepository): Response
    {
        if ($this->searchTerm) {
            return $this->search($this->searchTerm, $quoteRepository);
        }
        
        $quotes = $quoteRepository->findAllWithPage($this->page, self::LIMIT); 
        $paginatorHelper = new PaginatorHelper($this->page, count($quotes), self::LIMIT);

        
        return $this->render('quote/index.html.twig', [
            'quotes' => $quotes,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }
    private function search(string $searchTerm, QuoteRepository $quoteRepository): Response
    {
        $quotes =  $quoteRepository->search($searchTerm, $this->page, self::LIMIT);
        $paginatorHelper = new PaginatorHelper($this->page, count($quotes), self::LIMIT);

        return $this->render('quote/index.html.twig', [
            'searchTerm' => $searchTerm,
            'quotes' => $quotes,
            'paginatorHelper' => $paginatorHelper,
        ]);
    }

    #[Route('/pdf/{id}', name: 'pdf')]
    public function generatePdfDevis(Quote $quote, PdfService $pdf): Response
    {

        $customerLastName = $quote->getCustomer()->getLastname();
        $customerFirstName = $quote->getCustomer()->getFirstname();
        $status = $quote->getStatus();
        $company = $quote->getCustomer()->getCompany();
        $products = $quote->getProductQuotes();

        $IssuanceDate = $quote->getQuoteIssuanceDate()->format('Y-m-d');
        $ExpiryDate = $quote->getExpiryDate()->format('Y-m-d');
        $discount = $quote->getDiscount();
        $tva = $quote->getTva();

        $total = 0;
        $totalPriceSum = 0;
        $subtotal = 0;
        $tvaAmount = 0;
        $html = "";

        $html = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Devis</title>
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
                        width: 40%; 
                    }
                    .invoice-table th:nth-child(2),
                    .invoice-table td:nth-child(2) {
                        width: 15%; 
                    }
                    .invoice-table th:nth-child(3),
                    .invoice-table td:nth-child(3) {
                        width: 20%; 
                    }
                    .invoice-table th:nth-child(4),
                    .invoice-table td:nth-child(4) {
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
                    <h2>Devis</h2>
                    <div class='invoice-details'>
                        <p>Client: <strong> $customerLastName $customerFirstName </strong></p>
                        <p>Date d'échéance: <strong> " . $IssuanceDate . "</strong> </p>
                        <p>Date d'expriration: <strong> " . $ExpiryDate . "</strong> </p>
                        <p>Statut du devis:<strong>  $status </strong> </p>
                        <p style='text-align: center;'>----------------------------------------------------------------------------------------------------------------------------------</p>
                        <p>Entreprise:<strong>  $company </strong> </p>
                        <p>TVA:<strong>  $tva % </strong> </p>
                        <p>Réduction:<strong>  $discount % </strong> </p>
                    </div>
                    <table class='invoice-table'>
                        <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>               
            ";

        $categories = [];

        // Regrouper les produits par catégorie
        foreach ($quote->getProductQuotes() as $productQuote) {

            $product = $productQuote->getProduct();
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
                'quantity' => $productQuote->getQuantity(),
                'price' => $product->getPrice(),
                'totalPrice' => $product->getPrice() * $productQuote->getQuantity(),
            ];

            // Mise à jour du total des prix
            $totalPriceSum += $product->getPrice() * $productQuote->getQuantity();
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
                    <td style='text-align: center;'>{$product['totalPrice']} €</td>
                  </tr>";
            }
        }

        // Calcul de la TVA
        if ($tva) {
            $tvaAmount = $totalPriceSum * ($tva / 100); // Calcul de la TVA
        }

        // Calcul du total avec TVA
        $totalWithTva = $totalPriceSum + $tvaAmount;

        // Calcul du total avec remise si elle existe
        if ($discount) {
            $discountAmount = $totalWithTva * ($discount / 100); // Calcul du montant de la remise
            $totalWithDiscount = $totalWithTva - $discountAmount; // Calcul du total avec remise
        } else {
            $totalWithDiscount = $totalWithTva; // Si pas de remise, le total avec remise est le même que le total avec TVA
        }

        // Finalisation du HTML avec les totaux
        $html .=
            "</tbody>
            </table>
                    <div class='invoice-total'>
                        <p>Total: " . $totalPriceSum . " €</p>
                        <p>Total avec TVA: " . $totalWithTva .  " €</p>
                        <p>Total avec remise: " . $totalWithDiscount .  " €</p>
                    </div>
                </div>
        </body>
     </html>";

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

    #[Route('/{id}', name: 'to_bill', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function transformQuoteToBill(Request $request, $id,BillRepository $billRepository, QuoteRepository $quoteRepository,EntityManagerInterface $entityManager): Response
    {
        $quote = $quoteRepository->find($id);
        $existingBill = $billRepository->findOneBy(['quote' => $quote]);

        if (!$quote) {
            throw $this->createNotFoundException('Devis non trouvé');
        }

        $expiryDate = $quote->getExpiryDate();
        $currentDate = new \DateTime();

        if ($expiryDate < $currentDate) {
            $this->addFlash('warning', 'La date d\'expiration de ce devis est dépassée.');
            return $this->redirectToRoute('app_quote_index');
        }else{
            if ($existingBill) {
                // Si un enregistrement existe déjà, afficher un message et rediriger
                $this->addFlash('warning', 'Ce devis a déjà été transformé en facture.');
                return $this->redirectToRoute('app_quote_index'); // Rediriger vers la page des devis par exemple
            }else{
                //Créer une nouvelle facture
                $bill = new Bill();

                $user = $this->getUser();
                $company = $user->getCompany();

                $bill->setCustomer($quote->getCustomer());
                $bill->setDiscount($quote->getDiscount());
                $bill->setTva($quote->getTva());
                $bill->setEntreprise($company);
                $bill->setCreationDate(new \DateTime());
                $bill->setBillIssuanceDate(new \DateTime());
                $bill->setStatus('en attente');
                $bill->setQuote($quote);

                foreach ($quote->getProductQuotes() as $productQuote) {
                    $productBill = new ProductBill();
                    $productBill->setProduct($productQuote->getProduct());
                    $productBill->setQuantity($productQuote->getQuantity());
                    $productBill->setBill($bill); // Associer le produit à la nouvelle facture
                    $bill->addProductBill($productBill); // Ajouter le produit à la collection de produits de la facture
                }

                // Enregistrer la facture
                $entityManager->persist($bill);
                $entityManager->flush();

                // Rediriger vers la page de la nouvelle facture
                $this->addFlash('success', 'Le devis a été transformé en facture.');
                return $this->redirect($request->headers->get('referer'));        }
        }


    }
    
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MailerController $mailer): Response
    {
        // Get the logged-in user
        $user = $this->getUser();

        // Assuming your User entity has a method to get the associated company
        $company = $user->getCompany();

        // Create a new Quote instance
        $quote = new Quote();

        // Create the form
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quote);
            $entityManager->flush();

            $this->addFlash('success', 'Votre devis a été créé avec succès.');

            
            $formData = $form->getData();
            $customer = $formData->getCustomer();

            $mailer->newQuoteCreateEmail($customer);
        
            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quote/new.html.twig', [
            'quote' => $quote,
            'company' => $company, 
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Quote $quote, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // No need to iterate over productQuotes here, Symfony will handle it
            $entityManager->flush();
    
            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('quote/edit.html.twig', [
            'quote' => $quote,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete', name: 'deleteAll', methods: ['POST'])]
    public function deleteMany(Request $request, QuoteRepository $quoteRepository, EntityManagerInterface $entityManager): Response
    {
        $quotes = $request->request->all()['quotes'];
        $count = 0;
        dd($request);
        foreach($quotes as $id => $token){
            $quote = $quoteRepository->find($id);
            if($quote && $this->isCsrfTokenValid('delete'.$id, $token)){
                $entityManager->remove($quote);
                $count++;
            }
        }
        $this->addFlash('success', $count.' devis(s) supprimé(s) avec succès.');
        $entityManager->flush();
        return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Quote $quote): Response
    {
        return $this->render('quote/show.html.twig', [
            'quote' => $quote,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Quote $quote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quote->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
    }
}
