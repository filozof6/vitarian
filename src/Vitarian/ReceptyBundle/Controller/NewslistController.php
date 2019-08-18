<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vitarian\ReceptyBundle\Entity\Newslist;
use Vitarian\ReceptyBundle\Form\NewslistType;

/**
 * Newslist controller.
 *
 */
class NewslistController extends Controller
{

    /**
     * Lists all Newslist entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('VitarianReceptyBundle:Newslist')->findAll();

        return $this->render('VitarianReceptyBundle:Newslist:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Newslist entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Newslist();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newslist_show', array('id' => $entity->getId())));
        }

        return $this->render('VitarianReceptyBundle:Newslist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Newslist entity.
    *
    * @param Newslist $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Newslist $entity)
    {
        $form = $this->createForm(new NewslistType(), $entity, array(
            'action' => $this->generateUrl('newslist_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Newslist entity.
     *
     */
    public function newAction()
    {
        $entity = new Newslist();
        $form   = $this->createCreateForm($entity);

        return $this->render('VitarianReceptyBundle:Newslist:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Newslist entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Newslist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newslist entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VitarianReceptyBundle:Newslist:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Newslist entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Newslist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newslist entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('VitarianReceptyBundle:Newslist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Newslist entity.
    *
    * @param Newslist $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Newslist $entity)
    {
        $form = $this->createForm(new NewslistType(), $entity, array(
            'action' => $this->generateUrl('newslist_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Newslist entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('VitarianReceptyBundle:Newslist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newslist entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('newslist_edit', array('id' => $id)));
        }

        return $this->render('VitarianReceptyBundle:Newslist:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Newslist entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('VitarianReceptyBundle:Newslist')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Newslist entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newslist'));
    }

    /**
     * Creates a form to delete a Newslist entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('newslist_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
