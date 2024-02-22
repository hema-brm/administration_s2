<?php

namespace App\Controller\User\Account;

use App\Entity\User;
use App\Form\User\Current\Personal\PersonalInformationType;
use App\Form\User\Current\Security\ResetPasswordType;
use App\Form\User\Employee\EmployeeType;
use App\Service\File\FileUploadService;
use App\Service\User\Employee\AccessibleEmployeeService;
use App\Service\User\UserPasswordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account/me/', name: 'app_account_me_')]
class CurrentUserController extends AbstractController
{
    private bool $isAdmin;

    public const AVAILABLE_TABS = [
        'personal',
        'security',
    ];

    public function __construct(
        Security $security
    ) {
        $this->isAdmin = $security->isGranted('ROLE_ADMIN');
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(AccessibleEmployeeService $service, Security $security): Response
    {
        $user = $security->getUser();
        return $this->render('@user/account/current/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('edit', name: 'edit', methods: ['GET', 'POST'])]
    public function tabs(
        Security $security,
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordService $userPasswordService
    ): Response {
        $tabs = $request->query->get('tabs', 'personal');

        if (!in_array($tabs, self::AVAILABLE_TABS)) {
            $tabs = 'personal';
        }

        if ($tabs === 'personal') {
            return $this->personalTab($security, $request, $entityManager);
        }

        if ($tabs === 'security') {
            return $this->securityTab($security, $request, $entityManager, $userPasswordService);
        }

        return $this->redirectToRoute('app_account_me_index', [], Response::HTTP_SEE_OTHER);
    }

    private function personalTab(
        Security $security,
        Request $request,
        EntityManagerInterface $entityManager,
    )
    {
        $user = $security->getUser();
        $form = $this->createForm(PersonalInformationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Vos informations personnelles ont été modifiées avec succès.');
            return $this->redirectToRoute('app_account_me_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('@user/account/current/edit/index.html.twig', [
            'user' => $user,
            'form' => $form,
            'tabs' => 'personal',
        ]);
    }

    #[Route('security', name: 'security_tab', methods: ['GET', 'POST'])]
    public function securityTab(
        Security $security,
        Request $request,
        EntityManagerInterface $entityManager,
    )
    {
        $user = $security->getUser();

        $form = $this->createForm(ResetPasswordType::class, $user, [
            'user_before' => clone $user,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $entityManager->flush();

                $this->addFlash('success', 'Votre mot de passe a été modifié avec succès.');
                return $this->redirectToRoute('app_account_me_index', [], Response::HTTP_SEE_OTHER);
            }
            $entityManager->refresh($user);
            $this->addFlash('error', 'Une erreur est survenue lors de la modification de votre mot de passe.');
        }

        return $this->render('@user/account/current/edit/index.html.twig', [
            'user' => $user,
            'form' => $form,
            'tabs' => 'security',
        ]);
    }
}
