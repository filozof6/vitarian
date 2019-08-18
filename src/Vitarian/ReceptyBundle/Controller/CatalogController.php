<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vitarian\ReceptyBundle\Entity\CtLinks;
use Vitarian\ReceptyBundle\Entity\CtCat;
use Vitarian\ReceptyBundle\Form\CtLinksType;

/**
 * Post controller.
 *
 */
class CatalogController extends Controller {

    /**
     * Lists all Post entities.
     *
     */
    public function indexAction() {
        $var = $this->getDoctrine()->getRepository('VitarianReceptyBundle:CtCat');
        $entities = $var->findBy(array("parent" => NULL));
        //echo "<pre>";\Doctrine\Common\Util\Debug::dump($entities);echo "</pre>";die();

        return $this->render('VitarianReceptyBundle:Catalog:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Lists all lnks entities in current category.
     *
     */
    public function showAction($name) {
        $var = $this->getDoctrine()->getRepository('VitarianReceptyBundle:CtCat');
        $ctCat = $var->findOneBy(array("name" => $name));
        //echo "<pre>";\Doctrine\Common\Util\Debug::dump($ctCat);echo "</pre>";die();
        if (!$ctCat) throw $this->createNotFoundException('Unable to find CtCat entity with name:'.$name);
        return $this->render('VitarianReceptyBundle:Catalog:show.html.twig', array(
                    'ctCat' => $ctCat,
        ));
    }

    /**
     * Create new link
     *
     */
    public function newAction(Request $request) {
        if (!$this->getUser()) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $entity = new CtLinks();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        // treba tu dorobit formulár na pridávanie ak nebude užívateľ prihlásený pošle ho to na login

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
                  //    echo "<pre>";\Doctrine\Common\Util\Debug::dump($entity);echo "</pre>";die();
            $em->persist($entity);
            $em->flush();
            // vrati ju do kategorie kde bol link umiestneny
            return $this->redirect($this->generateUrl('catalog_show', array("name"=>$entity->getCategory()->getName()) ));
        }
        // vykresli formulár
        return $this->render('VitarianReceptyBundle:Catalog:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CtLink entity.
     *
     * @param CtLink $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CtLinks $entity) {

        $form = $this->createForm(new CtLinksType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('catalog_add'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));



        return $form;
    }
    
     public function breadCrumbsAction($entity)
    {     
        $category =$entity;
        $pole[0]=$category;
        //echo "<pre>";\Doctrine\Common\Util\Debug::dump($pole);echo "</pre>";die();
        while ($category->hasParent()) {
            $pole[]=$category->getParent();
            $category=$category->getParent();
        }
        $pole= array_reverse($pole);
         
        return $this->render('VitarianReceptyBundle:Catalog:breadCrumbs.html.twig', array(
            'pole'      => $pole,
        ));
    }
    
    /**
     * Show link in detail
     *
     */
    public function linkAction($name) {
        $var = $this->getDoctrine()->getRepository('VitarianReceptyBundle:CtLinks');
        $ctLink = $var->findOneBy(array("name" => $name));
        //echo "<pre>";\Doctrine\Common\Util\Debug::dump($ctCat);echo "</pre>";die();
        if (!$ctLink) throw $this->createNotFoundException('Unable to find CtCat entity with name:'.$name);
        return $this->render('VitarianReceptyBundle:Catalog:link.html.twig', array(
                    'ctLink' => $ctLink,
        ));
    }

}
