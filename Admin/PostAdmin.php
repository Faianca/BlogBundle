<?php

/*
 *  @category   Blog Bundle
 *  @package    Admin / SonataBundle
 *  @copyright  2011 jorgemeireles.com - Jorge Meireles
 *  @license    Simplified BSD
 *  @author     Jorge Meireles (info@jorgemeireles.com)
 */

namespace Faianca\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

class PostAdmin extends Admin
{
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('enabled')
            ->add('title')
            ->add('content')
            ->add('category')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('enabled', null, array('required' => false))
                ->add('title')
                ->add('content')
                ->add('category')
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('title')
            ->add('category')    
            ->add('enabled')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('enabled');
            /*->add('tags', 'orm_many_to_many', array('filter_field_options' => array('expanded' => true, 'multiple' => true)))
            ->add('with_open_comments', 'callback', array(
                'template' => 'SonataAdminBundle:CRUD:filter_callback.html.twig',
                'filter_options' => array(
                    'filter' => array($this, 'getWithOpenCommentFilter'),
                    'type'   => 'checkbox'
                ),
                'filter_field_options' => array(
                    'required' => false
                )
            ))
            */
    }

    public function getWithOpenCommentFilter($queryBuilder, $alias, $field, $value)
    {
        if (!$value) {
            return;
        }

        //$queryBuilder->leftJoin(sprintf('%s.comments', $alias), 'c');
        $queryBuilder->andWhere('c.status = :status');
        $queryBuilder->setParameter('status', Comment::STATUS_MODERATE);
    }

    protected function configureSideMenu(MenuItemInterface $menu, $action, Admin $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, array('edit'))) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;

        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            $this->trans('view_post'),
            array('uri' => $admin->generateUrl('edit', array('id' => $id)))
        );

        /*$menu->addChild(
            $this->trans('link_view_comment'),
            array('uri' => $admin->generateUrl('faianca.blog.admin.comment.list', array('id' => $id)))
        );*/
    }
}