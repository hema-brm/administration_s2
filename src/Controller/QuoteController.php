<?php
//QuoteController.php
namespace App\Controller;

use App\Entity\Quote;
use App\Entity\Bill;
use App\Entity\ProductBill;
use App\Form\QuoteType;
use App\Repository\QuoteRepository;
use App\Repository\UserRepository;
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

#[Route('/quote')]
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

    #[Route('/', name: 'app_quote_index', methods: ['GET'])]
    public function index(QuoteRepository $quoteRepository, UserRepository $userRepository): Response
    {
    $user = $this->getUser(); // Récupère l'utilisateur connecté
    $quotes = [];

    // Vérifie si l'utilisateur est connecté
    if ($user) {
        // Récupère l'entreprise de l'utilisateur connecté
        $userCompany = $user->getCompany();

        // Si l'utilisateur appartient à une entreprise
        if ($userCompany) {
            // Récupère les factures de l'entreprise de l'utilisateur connecté
            $quotes = $quoteRepository->findBy(['company' => $userCompany]);
        }
    }

    return $this->render('quote/index.html.twig', [
        'quotes' => $quotes,
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
    

    #[Route('/{id}', name: 'app_quote_to_bill', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function transformQuoteToBill(Request $request, $id,BillRepository $billRepository, QuoteRepository $quoteRepository,EntityManagerInterface $entityManager): Response
    {
        
        
        $quote = $quoteRepository->find($id);
        $existingBill = $billRepository->findOneBy(['quote' => $quote]);
        
        if (!$quote) {
            throw $this->createNotFoundException('Devis non trouvé');
        }

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
        $bill->setTotalPrice($quote->getTotalPrice()); 
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


    #[Route('/new', name: 'app_quote_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get the logged-in user
        $user = $this->getUser();

        // Assuming your User entity has a method to get the associated company
        $company = $user->getCompany();

        // Create a new Quote instance
        $quote = new Quote();
        

        $quote->addProductQuote(new ProductQuote());



        // Set the company information in the Quote form
        $quote->setCompany($company);

        // Create the form
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($quote->getProductQuotes() as $productQuote) {
                $productQuote->setQuote($quote);
                $entityManager->persist($productQuote);
            }
        
            $entityManager->persist($quote);
            $entityManager->flush();
        
            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quote/new.html.twig', [
            'quote' => $quote,
            'company' => $company, 
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_quote_edit', methods: ['GET', 'POST'])]
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
    

    #[Route('/{id}/show', name: 'app_quote_show', methods: ['GET'])]
    public function show(Quote $quote): Response
    {
        return $this->render('quote/show.html.twig', [
            'quote' => $quote,
        ]);
    }

    

    #[Route('/{id}', name: 'app_quote_delete', methods: ['POST'])]
    public function delete(Request $request, Quote $quote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quote->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
    }
}
