<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Login controller.
 *
 */
class LoginController extends Controller {

    /**
     * Shows login div on the template
     *
     */
    public function indexAction() {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->findUserByUsername($this->container->get('security.context')
                        ->getToken()
                        ->getUser());
        if ($user) {
            return $this->render('VitarianReceptyBundle:Default:login.html.twig', array( 'user'=>$user));
           // return $this->render('VitarianReceptyBundle:Default:login.html.twig');
        } else {
           return $this->render('VitarianReceptyBundle:Default:login.html.twig');
        }
        
    }

}
