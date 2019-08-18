<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vitarian\ReceptyBundle\Entity\Category;

class AboutusController extends Controller
{
    public function indexAction()
    {
  
        return $this->render('VitarianReceptyBundle:Default:aboutus.html.twig');
    }
}
