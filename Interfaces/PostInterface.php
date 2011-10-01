<?php
/**
 * Post Interface
 *
 * @category   Blog Bundle
 * @package    Interfaces
 * @copyright  2011 jorgemeireles.com - Jorge Meireles
 * @license    Simplified BSD
 * @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Interfaces;

interface PostInterface {
 
    /**
     * Set title
     *
     * @param string $title
     */
    function setTitle($title);
    
    /**
     * Get title
     *
     * @return string $title
     */
    function getTitle();
     
    /**
     * Set slug
     *
     * @param string $slug
     */
    function setSlug($slug);
    
    /**
     * Get slug
     *
     * @return string $slug
     */
    function getSlug();
    
    /**
     * Set author
     *
     * @param string $author
     */
    function setAuthor($author);
    
    /**
     * Get author
     *
     * @return string $author
     */
    function getAuthor();
    
    /**
     * Set enabled
     *
     * @param boolean $enabled
     */
    function setEnabled($enabled);
    
    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    function getEnabled();
 
    /**
     * Get Content
     *
     * @return test $content
     */
    function getContent();
    
    /**
     * Set content
     *
     * @param text $content
     */
    function setContent($content);
    
    function addComment(\Faianca\BlogBundle\Entity\Comment $comments);
    
    function getComments();
}
?>
