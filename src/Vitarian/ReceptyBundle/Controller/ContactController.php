<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function indexAction()
    {
        $request = new Request();
            
        $form = $this->createFormBuilder()
            ->add('title', 'text' , array(
                                        'label'  => 'Title: ',
                                    ))
            ->add('name', 'text', array(
                                        'label'  => 'Name: ',
                                    ))
            ->add('email', 'email', array(
                                        'label'  => 'Email: ',
                                    ))
            ->add('body', 'textarea', array(
                                        'label'  => 'Body: ',
                                    ))
            ->add('send', 'submit', array(
                                        'label'  => 'Send',
                                    ))
            ->getForm();
        $form->handleRequest($request);

    if ($form->isValid()) {
        // tu sa bude posielat mail

        return $this->redirect($this->generateUrl('VitarianReceptyBundle:Default:succes'));
    }
        return $this->render('VitarianReceptyBundle:Default:contact.html.twig', array('form' => $form->createView()));
    }
     public function succesAction()
    {
     
        return $this->render('VitarianReceptyBundle:Default:succes.html.twig', array("message" => "Feedback sent.") );
    }
}
