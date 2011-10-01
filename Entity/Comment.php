<?php
/*
 *  @category   Blog Bundle
 *  @package    Controller
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Faianca\BlogBundle\Interfaces\CommentInterface;
use Faianca\BlogBundle\Helper\FaiancaCore;

/**
 * Faianca\BlogBundle\Entity\Comment
 *
 * @ORM\Entity(repositoryClass="Faianca\BlogBundle\Entity\Repository\CommentRepository")
 * @ORM\Table(name="comments")
 * @ORM\Entity
 */
class Comment implements CommentInterface {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     * @Assert\MaxLength("255")
     * @var name
     */
    protected $name;
    
    /**
     * @ORM\Column(name="email", type="string")
     * @Assert\NotBlank()
     * @Assert\MaxLength("255")
     * @var email
     */
    protected $email;
    
    /**
     * @ORM\Column(name="message", type="text")
     * @Assert\MaxLength("5000")
     * @var message
     */
    protected $message;
    
    /**
     * @ORM\Column(name="url", type="string")
     * @Assert\NotBlank()
     * @Assert\MaxLength("255")
     * @var url
     */
    protected $url;
    
    /**
     * @var post
     *
     * @ORM\ManyToOne(targetEntity="Faianca\BlogBundle\Entity\Post")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post", referencedColumnName="id")
     * })
     */    
    protected $post;
    
    /**
     * @ORM\Column(name="date_created", type="datetime")
     * @Assert\NotBlank()
     * @var \DateTime
     */
    protected $createdAt;
    
    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */  
    protected $status = self::STATUS_VALID;
    
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        
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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param text $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return text 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * Set createdAt
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $date = FaiancaCore::dateFormat($createdAt);
        $this->createdAt = $date;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set stauts
     *
     * @param integer $stauts
     */
    public function setStatus($stauts)
    {
        $this->stauts = $stauts;
    }

    /**
     * Get stauts
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->stauts;
    }

    /**
     * Set post
     *
     * @param Faianca\BlogBundle\Entity\Post  $post
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Get post
     *
     * @return Faianca\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}