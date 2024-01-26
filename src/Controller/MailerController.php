<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Mailer;
use App\Entity\Customer;

class MailerController extends AbstractController
{

    #[Route('/{id}/mailer', name: 'app_mailer')]
    public function index(Mailer $mailer, Customer $customer): Response
    {
        if($customer){
            $email = $customer->getEmail();
            $lastname = $customer->getLastname();
            $firstname = $customer->getFirstname();
            $company = $customer->getCompany()->getName();
        }
        $sendMail = $mailer->sendTemplate(2, [['email' => $email]], [
                                                                        'company' => $company,
                                                                        'lastname' => $lastname,
                                                                        'firstname' => $firstname                                                           
                                                                    ]); 
        
        if($sendMail){
            $this->addFlash('success', "Le mail a été envoyé avec succès.");
        }
        else{
            $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
        }
         return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);
    }

}
