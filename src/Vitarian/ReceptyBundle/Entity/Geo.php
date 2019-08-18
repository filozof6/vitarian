<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vitarian\ReceptyBundle\Entity\SearchableInterface;

/**
 * Geo
 */
class Geo implements SearchableInterface
{
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longtitude;
    
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $report=0;
    /**
     * @var \Vitarian\ReceptyBundle\Entity\User
     */
    private $author;

    /**
     * @var integer
     */
    private $id;
    
    private $type=null;

    public function __construct(){
        $this->type=null;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Geo
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longtitude
     *
     * @param float $longtitude
     * @return Geo
     */
    public function setLongtitude($longtitude)
    {
        $this->longtitude = $longtitude;

        return $this;
    }

    /**
     * Get longtitude
     *
     * @return float 
     */
    public function getLongtitude()
    {
        return $this->longtitude;
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return Geo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set description
     *
     * @param string $description
     * @return Geo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set report
     *
     * @param integer $report
     * @return Geo
     */
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get report
     *
     * @return integer 
     */
    public function getReport()
    {
        return $this->report;
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
  
    public function __toString()
    {
        return $this->title;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
         $this->type=$type;
         return $this;
    }
     public function getSearchName(){
         return $this->getTitle();
      }
    public function getSearchCategory(){
        return $this->getType()->getName();
    }
     /**
     * Set author
     *
     * @param \Vitarian\ReceptyBundle\Entity\User $author
     * @return CtLinks
     */
    public function setAuthor(\Vitarian\ReceptyBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Vitarian\ReceptyBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
       
}
