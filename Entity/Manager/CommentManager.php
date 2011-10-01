<?php

/*
 *  @category   Blog Bundle
 *  @package    Manager
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */
namespace Faianca\BlogBundle\Entity\Manager;

use Faianca\BlogBundle\Interfaces\CommentInterface;
use Doctrine\ORM\EntityManager;

class CommentManager
{
    protected $em;
    protected $class;

    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    public function save(CommentInterface $comment)
    {
        $this->em->persist($comment);
        $this->em->flush();
    }

    public function getClass()
    {
        return $this->class;
    }

    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }

    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }

    public function delete(CommentInterface $comment)
    {
        $this->em->remove($comment);
        $this->em->flush();
    }

    public function create()
    {
        return new $this->class;
    }


}