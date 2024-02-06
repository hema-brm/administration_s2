<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Mailer;
use App\Entity\Customer;

class MailerController extends AbstractController
{
    public function __construct(Mailer $mailer) {
        $this->mailer = $mailer;
    }
    #[Route('/{id}/mail', name: 'app_mailer')]
    public function reminderMail(Customer $customer): Response
    {
        $mail = $this->mailer->sendMail(3, $customer);

        if($mail){
            $this->addFlash('success', "Le mail a été envoyé avec succès.");
        }
        else{
            $this->addFlash('error', "Une erreur s'est produite lors de l'envoi du mail.");
        }

        return $this->redirectToRoute('app_quote_index', [], Response::HTTP_SEE_OTHER);                                     
    }

}
