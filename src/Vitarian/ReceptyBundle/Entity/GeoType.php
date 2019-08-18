<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredients
 */
class GeoType
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
    private $description;
    
    private $icon;
    
    private $geos;


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
     * Set name
     *
     * @param string $name
     * @return Ingredients
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
     /**
     * Get name
     *
     * @return string 
     */
    public function getGeos()
    {
        return $this->geos;
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
    public function getIcon()
    {
        return $this->icon;
    }
     public function setIcon($icon)
    {
         $this->icon=$icon;
        return $this;
    }
    public function __toString() {
        return $this->getName();
    }
}
