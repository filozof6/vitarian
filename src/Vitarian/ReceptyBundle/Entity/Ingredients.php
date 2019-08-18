<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vitarian\ReceptyBundle\Entity\SearchableInterface;

/**
 * Ingredients
 */
class Ingredients implements SearchableInterface
{
  
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;
    
     /**
     * @var integer
     */
    private $posts;


    /**
     * Set name
     *
     * @param string $name
     * @return Ingredients
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
     /**
     * Get name
     *
     * @return string 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    public function __toString() {
        return $this->getName();
    }
     public function getSearchName(){
         return $this->getName();
      }
    public function getSearchCategory(){
        return "ingredients";
    }
}
