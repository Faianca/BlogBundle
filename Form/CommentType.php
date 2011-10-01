<?php

/*
 *  @category   Blog Bundle
 *  @package    Form
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Form;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class CommentType extends AbstractType {
    
    /**
     * Instructs the construction of forms of this type
     *
     * @param \Symfony\Component\Form\FormBuilder $builder
     * @param array $options
     * @return void
     */ 
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name');
        $builder->add('email');
        $builder->add('url');
        $builder->add('message');
    }
    
    /**
     * Get Param
     *
     * @return string $param
     */
    public function getName()
    {
        return 'faianca_comment';
    }
}
