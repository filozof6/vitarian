<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vitarian\ReceptyBundle\Entity\Post;
use Vitarian\ReceptyBundle\Entity\Category;
use Vitarian\ReceptyBundle\Form\PostType;


/**
 * Post controller.
 *
 */
class PostController extends Controller
{

    /**
     * Lists all Post entities.
     *
     */
    public function indexAction($name="Recipes",$page=1)
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('VitarianReceptyBundle:Post')->findAll();
       // $entities = $em->getRepository('VitarianReceptyBundle:Post')->findBy(array("category:name"=>$catName), null, 10, $page);
        $category= $em->getRepository('VitarianReceptyBundle:Category')->findOneBy(array("name"=>$name));
        $entities = $category->getPosts();
      /*  echo "<pre>";
        \Doctrine\Common\Util\Debug::dump($entities);
        echo "</pre>";*/
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', $page), //page number
            1 //limit per page
        );
        
        return $this->render('VitarianReceptyBundle:Post:index.html.twig', array(
            'entities' => $entities,'category'=>$category, 'pagination'=>$pagination,
        ));
    }
    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Post();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
     /*   echo "<pre>";
        \Doctrine\Common\Util\Debug::dump($entity);
        echo "</pre>";
            die();*/
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        return $this->render('VitarianReceptyBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Post $entity)
    {
        $form = $this->createForm(new PostType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
            
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));
        
        

        return $form;
    }

    /**
     * Displays a form to create a new Post entity. Only for logged users
     *
     */
    public function newAction()
    {
        if (!$this->getUser()) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $entity = new Post();
        $form   = $this->createCreateForm($entity);

        return $this->render('VitarianReceptyBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($name)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Post')->findOneBy(array("title"=>$name));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());
        /* echo "<pre>";
        \Doctrine\Common\Util\Debug::dump($entity);
        echo "</pre>";*/
        return $this->render('VitarianReceptyBundle:Post:show.html.twig', array(
            'entity'      => $entity,
            'delete_form'      => $deleteForm->createView(),
                    ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VitarianReceptyBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Post $entity)
    {
        if (!$this->getUser()) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $form = $this->createForm(new PostType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return $this->render('VitarianReceptyBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VitarianReceptyBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    public function recentPostsAction($idCategory, $quantity, $string)
    {
        $posts = $this->getDoctrine()
        ->getRepository('VitarianReceptyBundle:Post')->findBy(array("category"=>$idCategory), null, $quantity);
        
        return $this->render('VitarianReceptyBundle:Post:recent.html.twig', array(
            'entities' => $posts,"title"=>"recipes","string"=>$string
        ));
    }
    /**
     * Ajaxová akcia ktorá nefunguje z nenznámeho dovodu.... 
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function ajaxRankAction(Request $request)
    {
        $rank = $request->get('rank');
        $id =$request->get("id");
        $rank = $rank."";
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('VitarianReceptyBundle:Post')->findOneById($id); 
        $str="Nothing happened";
        if ($rank=="+") {
            $post->setLike($post->getLike()+1);
            $str="Rank increased";
        } else if($rank=="-" ) {
            $post->setDislike($post->getDislike()+1);
            $str="Rank decreased";
        } 
        
        $em->flush();
        echo $str;
    }
    public function imageSliderAction($idCategory,$id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $this->getDoctrine()
        ->getRepository('VitarianReceptyBundle:Post')->getPostsInCategory($idCategory);
        shuffle($entities); // <==== Randomization and limit of images
        $entities = array_slice($entities, 0, 15);
        return $this->render('VitarianReceptyBundle:Post:imageSlider.html.twig', array(
            'entities' => $entities, 'id' => $id ));
    }
    /**
     * 
     */
}
