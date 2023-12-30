<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/mailer', name: 'app_mailer')]
    public function index(): Response
    {
        $destinataire = 'hema932001@gmail.com';
        $objet = 'Rappel de devis';
        $contenu = 'Voici un rappel de votre devis.';

        try{
            $this->envoyerMail($destinataire, $objet, $contenu);
            return new Response('E-mail de rappel envoyé avec succès !');

        }catch (\Exception $e) {
            return new Response('Erreur lors de l\'envoi de l\'e-mail : ' . $e->getMessage());
        }
        // Envoyer l'e-mail
        
    }

    private function envoyerMail($destinataire, $objet, $contenu)
    {
        $message = (new Email())
            ->from('queen93123@hotmail.com')
            ->to($destinataire)
            ->subject($objet)
            ->text($contenu);

        $this->mailer->send($message);
    }
}
