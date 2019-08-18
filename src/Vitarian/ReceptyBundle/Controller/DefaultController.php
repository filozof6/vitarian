<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        
        return $this->render('VitarianReceptyBundle:Default:index.html.twig', array('name' => $name));
    }
    public function menuAction()
    {
       $articles = $this->getDoctrine()
    ->getRepository('VitarianReceptyBundle:Category')->findBy(array("parent"=>4), array("name"=>"ASC"));
      
        $recipes = $this->getDoctrine()
    ->getRepository('VitarianReceptyBundle:Category')->findBy(array("parent"=>3), array("name"=>"ASC"));
       //  echo "<pre>";\Doctrine\Common\Util\Debug::dump($recipes);echo "</pre>";die;
        return $this->render('VitarianReceptyBundle:Default:menu.html.twig', array('recipes' => $recipes,'articles' => $articles,));
    }
    public function loginAction(Request $request)
    {
        if ($request->getMethod()=="POST") {
            $username=$request->get("username");
            $password=$request->get("password");
            
            $em = $this->getDoctrine()->getEntityManager();
            $repository = $em->getRepository("VitarianReceptyBundle:User");
            $user = $repository->findOneBy(array("username"=>$username,"password"=>$password));
            // ak sa prihlasil
            if ($user) {
                 return $this->render('VitarianReceptyBundle:Default:login.html.twig', array('error' => "existuje",));
            } else {
             return $this->render('VitarianReceptyBundle:Default:login.html.twig', array('error' => "neexistuje",));
        } 
        }

        else {
             return $this->render('VitarianReceptyBundle:Default:login.html.twig', array('error' => "prihlás sa",));
        }
       
    }
    
    
}
