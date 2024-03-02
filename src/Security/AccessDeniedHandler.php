<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\Security\Core\Security;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {   
        $user = $this->security->getUser();

        if($user === null){
            dd('ici');
            $referer = '/';
        }
        else{
            $userRoles = $user->getRoles();
            if(in_array('ROLE_ADMIN', $userRoles) || in_array('ROLE_ENTREPRISE', $userRoles)){
                $referer = '/employee';
            }
            else if(in_array('ROLE_EMPLOYEE', $userRoles)){
                $referer = '/customer';
            }
            else if(in_array('ROLE_COMPTABLE', $userRoles)){
                $referer = '/accountant';
            }
        }

        $response = new RedirectResponse($referer);

        $session = $request->getSession();
        $session->getFlashBag()->add('error', 'Vous n\'avez pas les droits pour accéder à cette page.');

        return $response;
    }
}

?>