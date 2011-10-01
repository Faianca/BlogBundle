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

/**
 * Faianca\BlogBundle\Entity\Category
 *
 * @ORM\Entity(repositoryClass="Faianca\BlogBundle\Entity\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category {
    
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
     * @var string
     */
    protected $name;
    
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
    
    public function __toString()
    {
        return $this->getName();
    }
}