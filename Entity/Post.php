<?php

/**
 * Post Entity
 *
 * @category   Blog Bundle
 * @package    Entity
 * @copyright  2011 jorgemeireles.com - Jorge Meireles
 * @license    Simplified BSD
 * @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Faianca\BlogBundle\Interfaces\PostInterface;
use Faianca\BlogBundle\Helper\FaiancaCore;

/**
 * Faianca\BlogBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Faianca\BlogBundle\Entity\Repository\PostRepository")
 * @ORM\Table(name="blog")
 * @ORM\Entity
 */
class Post implements PostInterface {
    
 
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
    
     /**
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank()
     * @Assert\MaxLength("255")
     * @var string
     */
     protected $title;
     
     /**
     * @ORM\Column(name="slug", type="string")
     * @Assert\MaxLength("255")
     * @Assert\NotBlank()
     * @var string
     */
     protected $slug;
     
     
     /**
     * @ORM\Column(name="date_created", type="datetime")
     * @Assert\NotBlank()
     * @var \DateTime
     */
     protected $dateCreated;
     
     /**
     * @var author
     *
     * @ORM\ManyToOne(targetEntity="Faianca\SiteBundle\Entity\User")
     */
     protected $author;
     
     /**
     * @ORM\Column(name="content", type="text")
     * @Assert\MaxLength("5000")
     * @var text
     */
     protected $content;
  
     /**
     * @ORM\Column(name="enabled", type="boolean")
     * @var boolean
     */
     protected $enabled = false;
     
     /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Faianca\BlogBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
     protected $category;
     
     
    /**
     * @ORM\OneToMany(targetEntity="Faianca\BlogBundle\Entity\Comment", mappedBy="post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post", referencedColumnName="id")
     * })
     */
     protected $comments;
     
     /*
      * Initializes a new blog
      * 
      * Sets the author and date straight way
      */
     public function __construct()
     {
         $this->setDateCreated('now');
         $this->comments = new \Doctrine\Common\Collections\ArrayCollection;
     }
     
     /**
     * Sets the date this entity was created
     *
     * @throws \InvalidArgumentException
     * @param \DateTime|string|integer $date
     * @return Post *Fluent interface*
     */
    public function setDateCreated($date)
    {
        $date = FaiancaCore::dateFormat($date);
        $this->dateCreated = $date;
        return $this;
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
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->slug = FaiancaCore::slugify($title);
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = FaiancaCore::slugify($slug);
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get dateCreated
     *
     * @return datetime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set author
     *
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return Faianca\SiteBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
    /**
     * Get Content
     *
     * @return test $content
     */
    function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set content
     *
     * @param text $content
     */
    function setContent($content)
    {
        $this->content = $content;
    }
    
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Add comments
     *
     * @param Faianca\BlogBundle\Entity\Comment $comments
     */
    public function addComment(\Faianca\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set category
     *
     * @param Faianca\BlogBundle\Entity\Category $category
     */
    public function setCategory(\Faianca\BlogBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Faianca\BlogBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}