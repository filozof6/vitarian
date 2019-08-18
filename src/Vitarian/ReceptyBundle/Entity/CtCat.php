<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CtCat
 */
class CtCat
{
    /**
     * @var varchars
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\CtCat
     */
    private $parent;
    /**
     * @var ArrayCollection \Vitarian\ReceptyBundle\Entity\CtCat
     */
    private $children;
    
     /**
     * @var ArrayCollection \Vitarian\ReceptyBundle\Entity\CtLinks
     */
    private $links;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->links = new ArrayCollection();
    }
    /**
     * Set name
     *
     * @param integer $name
     * @return CtCat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    public function hasParent()
    {
        return ($this->parent?true:false);
    }

    /**
     * Get name
     *
     * @return integer 
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * Set parent
     *
     * @param \Vitarian\ReceptyBundle\Entity\CtCat $parent
     * @return CtCat
     */
    public function setParent(\Vitarian\ReceptyBundle\Entity\CtCat $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Vitarian\ReceptyBundle\Entity\CtCat 
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * Get children
     *
     * @return array \Vitarian\ReceptyBundle\Entity\CtCat 
     */
    public function getChildren()
    {
        return $this->children;
    }
    /**
     * Get links
     *
     * @return array \Vitarian\ReceptyBundle\Entity\CtLinks
     */
    public function getLinks()
    {
        return $this->links;
    }
    /**
     * Get string representation of the object
     *
     * @return string representation
     */
    public function __toString()
    {
        return $this->name;
    }
}
