<?php

/*
 *  @category   Blog Bundle
 *  @package    Interfaces
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Interfaces;

interface CommentInterface {

    const STATUS_INVALID = 0;
    const STATUS_VALID   = 1;
    
    /**
     * Set name
     *
     * @param string $name
     */
     function setName($name);
    
    /**
     * Get name
     *
     * @return string $name
     */
     function getName();
     
     function setEmail($email);
     
     function getEmail();
     
     function setMessage($message);
     
     function getMessage();
     
     function setUrl($url);
     
     function getUrl();
     
     function setCreatedAt($createdAt);
     
     function getCreatedAt();
     
     function setStatus($status);
     
     function getStatus();
}
