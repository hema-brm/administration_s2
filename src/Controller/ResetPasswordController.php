<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    // Autres actions...

    /**
     * @Route("/reset-password", name="app_reset_password_request")
     */
    public function request(Request $request, \Swift_Mailer $mailer)
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            // Vérifier si l'email existe dans la base de données et récupérer l'utilisateur
$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);

if (!$user) {
    // Gérer le cas où l'email n'est pas trouvé dans la base de données (afficher un message d'erreur, etc.)
} else {
    // Générer un token et stocker dans l'entité utilisateur
    $token = bin2hex(random_bytes(32)); // Génération d'un token aléatoire
    $user->setResetToken($token);
    $user->setTokenExpiration(new \DateTime('+1 hour')); // Date d'expiration du token

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($user);
    $entityManager->flush();

    // Envoyer un email à l'utilisateur avec le lien de réinitialisation
    $message = (new \Swift_Message('Réinitialisation de mot de passe'))
        ->setFrom('votre_email@votresite.com')
        ->setTo($email)
        ->setBody(
            $this->renderView(
                'reset_password/email.html.twig',
                ['token' => $token]
            ),
            'text/html'
        );

    $mailer->send($message);
    return $this->redirectToRoute('app_login');
}
            $message = (new \Swift_Message('Réinitialisation de mot de passe'))
                ->setFrom('votre_email@votresite.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        'reset_password/email.html.twig',
                        ['token' => $token]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            // Rediriger ou afficher un message de succès
            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/request.html.twig');
    }

    /**
 * @Route("/reset-password/{token}", name="app_reset_password_confirm")
 */
public function resetPasswordConfirm(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
{
    $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['resetToken' => $token]);

    if (!$user || $user->getTokenExpiration() < new \DateTime()) {
        // Gérer le cas où le token n'est pas valide ou expiré (afficher un message d'erreur, rediriger, etc.)
    } else {
        $form = $this->createFormBuilder()
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Nouveau mot de passe'],
                'second_options' => ['label' => 'Confirmez le nouveau mot de passe'],
            ])
            ->add('save', SubmitType::class, ['label' => 'Réinitialiser le mot de passe'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Mise à jour du mot de passe de l'utilisateur
            $newPassword = $form->getData()['password'];
            $encodedPassword = $passwordEncoder->encodePassword($user, $newPassword);

            $user->setPassword($encodedPassword);
            $user->setResetToken(null);
            $user->setTokenExpiration(null);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection ou affichage d'un message de succès
            return $this->redirectToRoute('app_login');
        }

        return $this->render('reset_password/reset_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

}
