<?php
//QuoteController.php
namespace App\Controller;

use App\Entity\Quote;
use App\Form\QuoteType;
use App\Repository\QuoteRepository;
use App\Service\Request\PageFromRequestService;
use App\Service\Request\RequestQueryService;
use App\Twig\Helper\Paginator\PaginatorHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProductQuote;
use App\Service\Mailer;

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
    
    #[Route('/new', name: 'app_quote_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Mailer $mailer): Response
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

            $formData = $form->getData();
            $customer = $formData->getCustomer();

            $sendMail = $mailer->sendMail(2, $customer);

            if($sendMail){
                $this->addFlash('success', "Le mail a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

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
    

    #[Route('/{id}', name: 'app_quote_show', methods: ['GET'])]
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
