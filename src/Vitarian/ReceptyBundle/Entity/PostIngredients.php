<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostIngredients
 */
class PostIngredients
{
    /**
     * @var integer
     */
    private $amount;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\Ingredients
     */
    private $ingredient;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\Post
     */
    private $post;


    /**
     * Set amount
     *
     * @param integer $amount
     * @return PostIngredients
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
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
     * Set ingredient
     *
     * @param \Vitarian\ReceptyBundle\Entity\Ingredients $ingredients
     * @return PostIngredients
     */
    public function setIngredient(\Vitarian\ReceptyBundle\Entity\Ingredients $ingredient = null)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \Vitarian\ReceptyBundle\Entity\Ingredients 
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set post
     *
     * @param \Vitarian\ReceptyBundle\Entity\Post $post
     * @return PostIngredients
     */
    public function setPost(\Vitarian\ReceptyBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Vitarian\ReceptyBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
    
    public function __toString() {
        return $this->getIngredient()->getName();
    }
    public function getName() {
        return $this->__toString();
    }
}
