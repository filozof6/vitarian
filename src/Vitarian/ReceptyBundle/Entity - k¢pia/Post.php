<?php

namespace Vitarian\ReceptyBundle\Entity;
use Vitarian\ReceptyBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
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

    public function __construct() {
        $this->published= new \DateTime();
        
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
    private $idAuthor;

    /**
     * @var \Vitarian\ReceptyBundle\Entity\Category
     */
    private $category;


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
     * Set idAuthor
     *
     * @param \Vitarian\ReceptyBundle\Entity\User $idAuthor
     * @return Post
     */
    public function setIdAuthor(\Vitarian\ReceptyBundle\Entity\User $idAuthor = null)
    {
        $this->idAuthor = $idAuthor;

        return $this;
    }

    /**
     * Get idAuthor
     *
     * @return \Vitarian\ReceptyBundle\Entity\User 
     */
    public function getIdAuthor()
    {
        return $this->idAuthor;
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
}
