<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Exception;
use Vitarian\ReceptyBundle\Entity\SearchableInterface;

/**
 * CtLinks
 */
class CtLinks implements SearchableInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\User
     */
    private $author;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\Geo
     */
    private $geo;
    
    /**
     * @var \Vitarian\ReceptyBundle\Entity\CtCat
     */
    private $category;
    


    /**
     * Set name
     *
     * @param string $name
     * @return CtLinks
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
     * Set description
     *
     * @param string $description
     * @return CtLinks
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
     * Get category
     *
     * @return \Vitarian\ReceptyBundle\Entity\CtCat 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Set category
     *
     * @return \Vitarian\ReceptyBundle\Entity\CtCat 
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
    /**
     * Set url
     *
     * @param string $url
     * @return CtLinks
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
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

    /**
     * Set geo
     *
     * @param \Vitarian\ReceptyBundle\Entity\Geo $geo
     * @return CtLinks
     */
    public function setGeo(\Vitarian\ReceptyBundle\Entity\Geo $geo = null)
    {
        if($geo == null) { throw $this->createNotFoundException('Unable to find entity geo.'); }
        $geo->setDescription($this->getDescription());
        $geo->setTitle($this->getName());
        $geo->setType(null);
        $geo->setAuthor($this->getAuthor());
        $this->geo = $geo;
        return $this;
    }

    /**
     * Get geo
     *
     * @return \Vitarian\ReceptyBundle\Entity\Geo 
     */
    public function getGeo()
    {
        return $this->geo;
    }
     public function getSearchName(){
         return $this->getName();
      }
    public function getSearchCategory(){
        return $this->getCategory()->getName();
    }
    public function __toString(){
        return $this->getName();
    }
   
}
