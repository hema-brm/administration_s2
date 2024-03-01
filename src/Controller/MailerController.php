<?php
namespace App\Controller;
use App\Controller\Quote\QuoteController;
use App\Entity\Bill;
use App\Entity\Customer;
use App\Entity\Quote;
use App\Service\Mailer;
use App\Service\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(name: 'app_mailer_')]
class MailerController extends AbstractController
{
        public function __construct(Mailer $mailer, PdfService $pdfService) {
            $this->mailer = $mailer;
            $this->pdfService = $pdfService;
            
            $this->templateNewQuoteID = $_ENV['TEMPLATE_NEW_QUOTE_ID'];
            $this->templateQuoteReminderID = $_ENV['TEMPLATE_QUOTE_REMINDER_ID'];
            $this->templateQuoteReplayID = $_ENV['TEMPLATE_QUOTE_REPLAY_ID'];
            
            $this->templateNewBillID = $_ENV['TEMPLATE_NEW_BILL_ID'];
            $this->templateBillReminderID = $_ENV['TEMPLATE_BILL_REMINDER_ID'];
            $this->templateBillReplayID = $_ENV['TEMPLATE_BILL_REPLAY_ID'];
            $this->templateBillLateID = $_ENV['TEMPLATE_BILL_LATE_ID'];
        }
        
        public function generateFilenameAndHTML(string $type, Customer $customer)
        {
            $generateNumber = rand(1000, 5000);
            $filename = $type."_".$customer->getId()."_".$generateNumber.'.pdf'; 

            return $filename;
        }

        #[Route('/{customer}/quoteReminderEmail', name: 'quoteReminderEmail')]
        public function quoteReminderEmail(Customer $customer): Response
        {   
            $email = $this->mailer->sendEmail($this->templateQuoteReminderID, $customer);

            if($email){
                $this->addFlash('success', "Le mail de rappel à été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/{customer}/{quote}/quoteReplayEmail', name: 'quoteReplayEmail')]
        public function quoteReplayEmail(Customer $customer,Quote $quote,PdfService $pdfService, QuoteController $quoteController): Response
        {
            $filename = $this->generateFilenameAndHTML('devis', $customer);
            $html = $quoteController->generateHtml($quote);
            //je sauvegarde dans un dossier tmp
            $pdfService->savePdf($html, $filename);

            $email = $this->mailer->sendEmail($this->templateQuoteReplayID, $customer, $filename);

            if($email){
                $this->addFlash('success', "Le PDF du devis a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/{customer}/{quote}/newQuoteCreateEmail', name: 'newQuoteCreateEmail')]
        public function newQuoteCreateEmail(Customer $customer, Quote $quote, PdfService $pdfService, QuoteController $quoteController): Response
        {
            $filename = $this->generateFilenameAndHTML('devis', $customer);
            $html = $quoteController->generateHtml($quote);
            //je sauvegarde dans un dossier tmp
            $pdfService->savePdf($html, $filename);

            $email = $this->mailer->sendEmail($this->templateNewQuoteID, $customer, $filename);

            if($email){
                $this->addFlash('success', "Le mail a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);  
        }
        
        #[Route('/{customer}/billReminderEmail', name: 'billReminderEmail')]
        public function billReminderEmail(Customer $customer, Bill $bill): Response
        {
            $email = $this->mailer->sendEmail($this->templateBillReminderID, $customer);
            
            if($email){
                $this->addFlash('success', "Le mail de rappel à été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/{customer}/{bill}/billReplayEmail', name: 'billReplayEmail')]
        public function billReplayEmail(Customer $customer, Bill $bill, PdfService $pdfService, BillController $billController): Response
        {
            $filename = $this->generateFilenameAndHTML('facture', $customer);
            $html = $billController->generateHtml($bill);
            //je sauvegarde dans un dossier tmp
            $pdfService->savePdf($html, $filename);
            $email = $this->mailer->sendEmail($this->templateBillReplayID, $customer, $filename);

            if($email){
                $this->addFlash('success', "Le PDF de la facture a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/{customer}/{bill}/billLateEmail', name: 'billLateEmail')]
        public function billLateEmail(Customer $customer, Bill $bill, PdfService $pdfService, BillController $billController): Response
        {
            $filename = $this->generateFilenameAndHTML('facture', $customer);
            $html = $billController->generateHtml($bill);
            //je sauvegarde dans un dossier tmp
            $pdfService->savePdf($html, $filename);
            $email = $this->mailer->sendEmail($this->templateBillLateID, $customer, $filename);

            if($email){
                $this->addFlash('success', "Le mail indiquant le retard de paiement a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/{customer}/{bill}/newBillCreateEmail', name: 'newBillCreateEmail')]
        public function newBillCreateEmail(Customer $customer, Bill $bill, PdfService $pdfService, BillController $billController): Response
        {
            $filename = $this->generateFilenameAndHTML('facture', $customer);
            $html = $billController->generateHtml($bill);
            //je sauvegarde dans un dossier tmp
            $pdfService->savePdf($html, $filename);
            $email = $this->mailer->sendEmail($this->templateNewBillID, $customer, $filename);

            if($email){
                $this->addFlash('success', "Le mail a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_bill_index', [], Response::HTTP_SEE_OTHER);  
        }

        
}