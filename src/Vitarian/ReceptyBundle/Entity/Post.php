<?php

namespace Vitarian\ReceptyBundle\Entity;
use Vitarian\ReceptyBundle\Entity\SearchableInterface;
use Vitarian\ReceptyBundle\Entity\User;
use Vitarian\ReceptyBundle\Entity\PostIngredients;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post implements SearchableInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;
    /**
     * @var \Vitarian\ReceptyBundle\Entity\Ingredients
     */
    private $ingredients;

    /**
     * @var \DateTime
     */
    private $published;

    /**
     * @var integer
     */
    private $like;

    /**
     * @var integer
     */
    private $dislike;

    /**
     * @var string
     */
    private $photo;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\User
     */
    private $author;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\Category
     */
    private $category;

    public function __construct() {
        $this->published= new \DateTime();
        $this->ingredients = new ArrayCollection();
        
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
     * Set title
     *
     * @param string $title
     * @return Post
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
     * Set body
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     * @return Post
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime 
     */
    public function getPublished()
    {
        return $this->published;
    }
    

    /**
     * Set like
     *
     * @param integer $like
     * @return Post
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get like
     *
     * @return integer 
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set dislike
     *
     * @param integer $dislike
     * @return Post
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

        return $this;
    }

    /**
     * Get dislike
     *
     * @return integer 
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Post
     */
    public function setPhoto(  $photo)
    {
                /* @var $photo UploadedFile */
        $name=  \time().'photo.'.substr($photo->getClientMimeType(),6);
        $photo->move(__DIR__.'/../../../../web/images/posts',$name);
        $this->photo = $name;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
       //return $this->getEncodedImage();
    }

    /**
     * Set author
     *
     * @param \Vitarian\ReceptyBundle\Entity\User $author
     * @return Post
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
     * Set category
     *
     * @param \Vitarian\ReceptyBundle\Entity\Category $category
     * @return Post
     */
    public function setCategory(\Vitarian\ReceptyBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Vitarian\ReceptyBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Get ingredients
     *
     * @return \Vitarian\ReceptyBundle\Entity\Ingredients
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
    /**
     * Get base64 encoded photo for embedding to web
     *
     * @return base64 encoded image
     */
    
   public function getEncodedImage()
    {
        
        $mime = "image/jpeg";

        return "data:".$mime.";base64," . base64_encode(stream_get_contents($this->photo));
    }
    /**
     * @var integer
     */
    private $liked;

    /**
     * @var integer
     */
    private $disliked;


    /**
     * Set liked
     *
     * @param integer $liked
     * @return Post
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * Get liked
     *
     * @return integer 
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * Set disliked
     *
     * @param integer $disliked
     * @return Post
     */
    public function setDisliked($disliked)
    {
        $this->disliked = $disliked;

        return $this;
    }

    /**
     * Get disliked
     *
     * @return integer 
     */
    public function getDisliked()
    {
        return $this->disliked;
    }
    public function toString(){
        return $this->title;
    }
    public function addIngredient(PostIngredients $tag)
    {
        $this->ingredients->add($tag);
        $tag->setPost($this);
    }

    public function removeIngredient(PostIngredients $tag)
    {
        $this->ingredients->removeElement($tag);
    }
    
      public function getSearchName(){
         return $this->getTitle();
      }
    public function getSearchCategory(){
        return $this->getCategory()->getCategoryType();
    }
    public function __toString(){
        return $this->getTitle();
    }
}
