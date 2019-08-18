<?php

namespace Vitarian\ReceptyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\Exception\LogicException;
        

/**
 * Category
 */
class Category
{
    const RECIPES_ID=3;
    const ARTICLES_ID=4;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Vitarian\ReceptyBundle\Entity\Category
     */
    private $parent;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var ArrayCollection() Vitarian\ReceptyBundle\Entity\Post
     */
    protected $posts;

    /**
     * @var ArrayCollection() Vitarian\ReceptyBundle\Entity\Category
     */
    protected $children;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->children = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getPosts()
    {
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
        return ($this->parent ? true : false);
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
     * Get children
     *
     * @return array \Vitarian\ReceptyBundle\Entity\CtCat 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Returns string representation of the current category depends of containing
     * type of post (recipe or article) according to bussines logic.
     * If the post in the nester category tree with root post id:3 its recipe.
     * On the oher tree which has root post id:4 its article.
     * @return string "recipes" | "articles")
     */
    public function getCategoryType()
    {
        // if it is recipe
        if ($this->treeContains(self::RECIPES_ID)) {
            return "recipes";
        } else if ($this->treeContains(self::ARTICLES_ID)) {
            return "articles";
        } else {
            throw new LogicException("getCategoryType(): Category without distinction. (Recipe|Article)");
        }
    }

    /**
     * Recursive method which determines if the category tree contains given id.
     * Search is being processed through the given id which is stated as a leaf 
     * to its root category.
     * @param int $id Id of category 
     * @return bool
     */
    public function treeContains($id)
    {
        if ($this->getId() == $id) {
            return true;
        } else if ($this->hasParent()) {
            return $this->getParent()->treeContains($id);
        } else {
            return false;
        }
    }

}
