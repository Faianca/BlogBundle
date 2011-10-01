<?php

/*
 *  @category   Blog Bundle
 *  @package    Manager
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */
namespace Faianca\BlogBundle\Entity\Manager;

use Faianca\BlogBundle\Interfaces\PostInterface;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;

class PostManager
{
    protected $em;
    protected $class;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param $class
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * @param \Faianca\BlogBundle\Interfaces\PostInterface $post
     * @return void
     */
    public function save(PostInterface $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param array $criteria
     * @return \Faianca\BlogBundle\Interfaces\PostInterface|null
     */
    public function findOneBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findOneBy($criteria);
    }

    /**
     * @param $year
     * @param $month
     * @param $day
     * @param $slug
     * @return \Faianca\BlogBundle\Interfaces\PostInterface|null
     */
    public function findOneBySlug($year, $month, $day, $slug)
    {
        try {
            return $this->em->getRepository($this->class)
                ->createQueryBuilder('p')
                ->where('p.publicationDateStart LIKE :publicationDateStart AND p.slug = :slug')
                ->setParameters(array(
                    'publicationDateStart' => sprintf('%s-%s-%s%%', $year, $month, $day),
                    'slug' => $slug
                ))
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * @param array $criteria
     * @return array
     */
    public function findBy(array $criteria)
    {
        return $this->em->getRepository($this->class)->findBy($criteria);
    }

    /**
     * @param \Faianca\BlogBundle\Interfaces\PostInterface $post
     * @return void
     */
    public function delete(PostInterface $post)
    {
        $this->em->remove($post);
        $this->em->flush();
    }

    /**
     * @return \Faianca\BlogBundle\Interfaces\PostInterface
     */
    public function create()
    {
        return new $this->class;
    }

    
}