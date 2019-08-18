<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $parent;

    /**
     * @var integer
     */
    private $id;
    
   

        protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }
    public function __toString() {
        return $this->name;
    }
 public function getPosts() {
        return $this->posts;
    }
    /**
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Set parent
     *
     * @param integer $parent
     * @return Category
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }
    public function hasParent()
    {
        return ($this->parent?true:false);
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
}
