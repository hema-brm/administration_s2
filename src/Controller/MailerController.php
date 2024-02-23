<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Mailer;
use App\Entity\Customer;
use Symfony\Component\HttpFoundation\Request;


#[Route(name: 'app_mailer_')]
class MailerController extends AbstractController
{
        private int $templateNewQuoteID;
        private int $templateReminderID;
        private int $templateReplyID;

        public function __construct(Mailer $mailer) {
            $this->mailer = $mailer;
            $this->templateNewQuoteID = $_ENV['TEMPLATE_NEW_QUOTE_ID'];
            $this->templateReminderID = $_ENV['TEMPLATE_REMINDER_ID'];
            $this->templateReplyID = $_ENV['TEMPLATE_REPLY_ID'];
        }

        #[Route('/{id}/email', name: 'reminderEmail')]
        public function reminderEmail(Customer $customer): Response
        {
            $email = $this->mailer->sendEmail($this->templateReminderID, $customer);

            if($email){
                $this->addFlash('success', "Le mail a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/email', name: 'reminderManyEmail')]
        public function reminderManyEmail(Request $request): Response
        {   //recuperer id ou customer PUIS utiliser la liste contznant les objets customer et le templateID
            //comme quote ou product(checkbox)
            //jai 2 forms, un avec name=quotes[] et lautre template[]. dans mon controlleur mail seul la deuxieme va etre pris en compte
            dd($request);
            $quotes = $request->request->all()['quotes'];
            dd($quotes);
            $count = 0;
            $templateId=2; //changer
            if($templateId == $this->templateReminderID){
                $template = $this->templateReminderID;
            }
            else{
                $template = $this->templateReplyID;
            }

            foreach($customers as $customer){
                if($customer){
                    $send = $this->mailer->sendEmail($this->template, $customer);
                    if($send){
                        $count++;
                    } 
                }
            }

            if($email){
                $this->addFlash('success', $count." mail(s) envoyé(s) avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi de mail(s).");
            }

            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);                                     
        }

        #[Route('/{id}/email', name: 'newQuoteCreateEmail')]
        public function newQuoteCreateEmail(Customer $customer): Response
        {
            $email = $this->mailer->sendEmail($this->templateNewQuoteID, $customer);

            if($email){
                $this->addFlash('success', "Le mail a été envoyé avec succès.");
            }
            else{
                $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
            }

            return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);  
        }                                   

        
}