<?php

namespace Vitarian\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vitarian\ReceptyBundle\Entity\Post;

class PostIngredientsAdmin extends Admin
{
    // Fields to be shown on create/edit forms
   protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('ingredient')
            ->add('post')
            ->add('amount') //if no type is specified, SonataAdminBundle tries to guess it
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('ingredient')
            ->add('post')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('ingredient')
            ->add('post')
            ->add('amount')
        ;
    }
}