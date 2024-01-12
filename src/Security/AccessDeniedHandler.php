<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {

        $referer = $request->headers->get('referer');

        if (empty($referer)) {
            $referer = '/';
        }

        $response = new RedirectResponse($referer);

        $session = $request->getSession();
        $session->getFlashBag()->add('error', 'Vous n\'avez pas les droits pour accéder à cette page.');

        return $response;
    }
}

?>