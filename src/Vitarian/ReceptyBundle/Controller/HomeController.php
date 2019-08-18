<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vitarian\ReceptyBundle\Entity\Post;
use Vitarian\ReceptyBundle\Entity\Category;

class HomeController extends Controller
{
    public function indexAction()
    {
      
           // echo "<pre>";\Doctrine\Common\Util\Debug::dump($this->getUser());echo "</pre>";

        return $this->render('VitarianReceptyBundle:Default:home.html.twig', array(
            
        ));
    }
}
