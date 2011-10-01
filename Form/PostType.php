<?php

/*
 *  @category   Blog Bundle
 *  @package    Form
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType {
    
    
    /**
     * Instructs the construction of forms of this type
     *
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     * @return void
     */ 
    public function buildForm(FormBuilder $builder, array $options)     
    {
        
        $builder->add('title', null);
        $builder->add('content', null);
        $builder->add('enabled', 'checkbox', array(
            'required' => false
        ));
    }


    /**
     * Get default options
     * @param $options
     * @return array
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Faianca\BlogBundle\Entity\Post',
        );
    }
    
    /**
     * Get name
     *
     * @return string
     */
        public function getName()
    {
        return 'faiancaPost';
    }
    
}