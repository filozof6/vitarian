<?php

namespace Vitarian\ReceptyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Vitarian\ReceptyBundle\Entity\Geo;
use Vitarian\ReceptyBundle\Form\GeoType;

class GeoController extends Controller
{

    public function indexAction()
    {
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Geo');
        $serializer = $this->container->get('serializer');
        $geos = $serializer->serialize($var->findAll(), 'json');
        return $this->render('VitarianReceptyBundle:Geo:index.html.twig', array('entities' => $geos));
    }

    public function showAction($name)
    {
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:GeoType');
        $geoType = $var->findOneBy(array("name" => $name));
        $serializer = $this->container->get('serializer');
        $geos = $serializer->serialize($geoType->getGeos(), 'json');
        // echo "<pre>";        \Doctrine\Common\Util\Debug::dump(json_encode($geos));        echo "</pre>";        die();
        return $this->render('VitarianReceptyBundle:Geo:index.html.twig', array('entities' => $geos));
    }

    public function locationsAction(Request $request)
    {
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Geo');
        $query = $var->createQueryBuilder('p')
                ->leftJoin('p.type', 'type')->addSelect("type")
                ->orderBy('p.id', 'ASC')
                ->getQuery();
        $locationsArray = $query->getArrayResult();

        // echo "<pre>";          \Doctrine\Common\Util\Debug::dump($locationsArray);          echo "</pre>"; die;
        return new JsonResponse($locationsArray);
    }

    public function newAction(Request $request)
    {
        if (!$this->getUser()) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        $entity = new Geo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        // treba tu dorobit formulár na pridávanie ak nebude užívateľ prihlásený pošle ho to na login

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //    echo "<pre>";\Doctrine\Common\Util\Debug::dump($entity);echo "</pre>";die();
            $em->persist($entity);
            $em->flush();
            // vrati ju do kategorie kde bol link umiestneny
            return $this->redirect($this->generateUrl('geo_show', array("name" => $entity->getType()->getName())));
        }
        // vykresli formulár
        return $this->render('VitarianReceptyBundle:Geo:new.html.twig', array(
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
    private function createCreateForm(Geo $entity)
    {

        $form = $this->createForm(new GeoType($this->getUser()), $entity, array(
            'action' => $this->generateUrl('geo_new'),
            'method' => 'POST',
        ));
        $form->add('title');
        $form->add('description');
        $form->add('type');
        $form->add('submit', 'submit', array('label' => 'Create'));



        return $form;
    }

    public function legendAction()
    {
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:GeoType');
        $entities = $var->findAll();
        // vykresli formulár
        return $this->render('VitarianReceptyBundle:Geo:legend.html.twig', array(
                    'entities' => $entities,
        ));
    }

    public function getJSONGeoAction(Request $request)
    {
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Geo')
                ->find($request->get("id"));
        $serializer = $this->container->get('serializer');

        return new JsonResponse($serializer->serialize($var, 'json'));
    }
    public function getJsonCloseMarkersAction(Request $request)
    {
        $radius=10;
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Geo')
                ->getCloseMarkers($request->get("latitude"),$request->get("longtitude"),$radius);
        $serializer = $this->container->get('serializer');
        
        return new JsonResponse($serializer->serialize($var, 'json'));
    }
    
     public function locateAction()
    {
        $var = $this->getDoctrine()
                ->getRepository('VitarianReceptyBundle:Geo');
        $entities = $var->findAll();
        // vykresli formulár
        return $this->render('VitarianReceptyBundle:Geo:locate.html.twig', array(
                    'entities' => $entities,
        ));
    }

}
