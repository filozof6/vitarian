<?php

namespace Vitarian\ReceptyBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vitarian\ReceptyBundle\Entity\Category;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{

    /**
     * Lists all Category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VitarianReceptyBundle:Category')->findAll();

        return $this->render('VitarianReceptyBundle:Category:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Category entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render('VitarianReceptyBundle:Category:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
    /**
     * Finds and displays a sub categories.
     *
     */
    public function subCatsAction($entity, $url)
    {
          //echo "<pre>";\Doctrine\Common\Util\Debug::dump($pole);echo "</pre>";die();
        return $this->render('VitarianReceptyBundle:Category:subCats.html.twig', array(
            'subCats'      => $entity->getChildren(), 'url'=>$url,
        ));
    }
     public function breadCrumbsAction($entity)
    {
        /*$em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('VitarianReceptyBundle:'.$entity)->findOneById($id);
        $pole[0]=$category;
        while ($category->hasParent()) {
            $category = $em->getRepository('VitarianReceptyBundle:'.$entity)->findOneById($category->getParent());
            $pole[]=$category;
        }
        $pole= array_reverse($pole);

        return $this->render('VitarianReceptyBundle:Category:breadCrumbs.html.twig', array(
            'pole'      => $pole,
        ));*/
         
        $category =$entity;
        $pole[0]=$category;
        //echo "<pre>";\Doctrine\Common\Util\Debug::dump($pole);echo "</pre>";die();
        while ($category->hasParent()) {
            $pole[]=$category->getParent();
            $category=$category->getParent();
        }
        $pole= array_reverse($pole);
         
        return $this->render('VitarianReceptyBundle:Category:breadCrumbs.html.twig', array(
            'pole'      => $pole,
        ));
    }
   
}
