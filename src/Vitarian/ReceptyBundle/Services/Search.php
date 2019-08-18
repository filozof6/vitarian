<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Vitarian\ReceptyBundle\Services;

use Vitarian\ReceptyBundle\Entity\Ingredients;

class Search
{

    /**
     *
     * @var Doctrine\ORM\EntityManager 
     */
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    /** main function providing the ultimate result
     * 
     * @param string $input Input from form
     */
    public function fetch($input)
    {
        return $this->em->getRepository("VitarianReceptyBundle:Post")->getPostsByIngredients($this->parseKeywords($input));
        
    }

    public function parseKeywords($input)
    {
        return explode(" ", $input);
    }

}
