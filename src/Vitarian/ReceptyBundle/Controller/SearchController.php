<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vitarian\ReceptyBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends Controller
{

    public function indexAction()
    {

        return $this->render('VitarianReceptyBundle:Helpers:search.html.twig');
    }

    public function searchAction(Request $request)
    {
        /* debug*/
          $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Post');
          $var->getPostsByIngredients(array("Apple", "Banana"));
        
        
        
        $form = $this->createSearchForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            /*      echo "<pre>";
              \Doctrine\Common\Util\Debug::dump($form->getData());
              echo "</pre>";die; */
            $formData = $form->getData();
            $searchEngine = $this->get("vitarian_services.search_engine");
            return $this->render('VitarianReceptyBundle:Search:search.html.twig', array(
                        'form' => $form->createView(),
                        'entities' => $searchEngine->fetch($formData["search"]),
            ));
        } else {

            return $this->render('::base.html.twig');
        }
    }

    public function searchFormAction(Request $request)
    {
        $form = $this->createSearchForm();
        $form->handleRequest($request);
        $form->get('search')->setData($request->get("search"));


        return $this->render('VitarianReceptyBundle:Search:form.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * Method which finds ingredient and send string representation via ajax
     */
    public function resultsAction(Request $request)
    {
         $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Ingredients');
        $query = $var->createQueryBuilder('a')
                ->select('a.name')
               ->where('LOWER(a.name) LIKE :name')
               ->setParameter('name', '%'.strtolower($request->get("input")).'%')
               ->getQuery();
        $ingredients = $query->getResult();
        $ingredientsArray=$ingredients;
    /*    foreach($ingredients as $ingredient) {
            $ingredientsArray[]=$ingredient->getName();
        }*/

       //  echo "<pre>";          \Doctrine\Common\Util\Debug::dump($ingredientsArray);          echo "</pre>"; die;
        return new JsonResponse($ingredientsArray);

    }

    public function createSearchForm($data = null)
    {
        $form = $this->createFormBuilder($data, array(
                    'action' => $this->generateUrl('search_search'),
                ))
                ->add('search', 'text', array(
                    "label" =>"Search by ingredients",
                    
                ))
                ->add('submit', 'submit')
                /*   ->add('sectors', 'choice', array(
                  'expanded' => true,
                  'multiple' => true,
                  'choices' => array(
                  'choices' => array(
                  'Recipes' => 'recipes',
                  'Articles' => 'articles',
                  'Catalog' => 'catalog',
                  'Geo' => 'geo',
                  ),
                  ),
                  )) */
                ->getForm();

        return $form;
    }

}
