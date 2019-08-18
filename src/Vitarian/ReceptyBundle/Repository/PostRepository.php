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
class PostRepository extends EntityRepository
{

    public function getPostsInCategory($idCategory)
    {

        $query = $this->getEntityManager()->createQuery('SELECT p
            FROM VitarianReceptyBundle:Post p
            WHERE p.category IN (SELECT c.id FROM VitarianReceptyBundle:Category c WHERE c.parent=:idCat OR c.id=:idCat )');
        $query->setParameters(array(
            'idCat' => $idCategory,
        ));
        return $query->getResult();
    }

    public function getPostsByIngredients($ingredientsArray)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        /*    Najde počet vyskytov danych ingrediencií */
        $qb->select("pi, COUNT(pi.post) as poc ")
                ->from("VitarianReceptyBundle:PostIngredients", "pi")
                ->innerJoin("pi.ingredient", "i")
                ->innerJoin("pi.post", "p")
                ->where("i.name  in (:ingredientsArray)")
                ->groupBy("pi.post")
                ->orderBy("poc", "DESC")
        ;
        $qb->setParameters(array(
            'ingredientsArray' => $ingredientsArray,
        ));
        $arrayPostIngredients = $qb->getQuery()->getResult();
        foreach ($arrayPostIngredients as $postIngredient) {
            $posts[] = $postIngredient[0]->getPost();
        }

        return $posts;
    }

}
