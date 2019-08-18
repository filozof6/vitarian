<?php

namespace Vitarian\ReceptyBundle\Repository;

use Symfony\Component\HttpFoundation\Request;
use Vitarian\ReceptyBundle\Entity\Post;
use Vitarian\ReceptyBundle\Entity\Category;
use Vitarian\ReceptyBundle\Form\PostType;
use Doctrine\ORM\EntityRepository;

/**
 * Post controller.
 *
 */
class GeoRepository extends EntityRepository
{

    public function getCloseMarkers($latitude,$longtitude,$radius)
    {
        $query = $this->getEntityManager()->createQuery('SELECT geo
            FROM VitarianReceptyBundle:Geo geo
            WHERE (geo.latitude BETWEEN :minLat AND :maxLat) AND
                  (geo.longtitude BETWEEN :minLong AND :maxLong)');
        $query->setParameters(array(
            'minLat' => $latitude-$radius,
            'maxLat' => $latitude+$radius,
            'minLong' => $longtitude-$radius,
            'maxLong' => $longtitude+$radius,
        ));
      //  echo "<pre>";\Doctrine\Common\Util\Debug::dump($query->getParameter('maxLong')->getValue());echo "</pre>";die();
        return $query->getResult();
    }

   

}
