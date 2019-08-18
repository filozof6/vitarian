<?php

namespace Vitarian\ReceptyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
           // ->add('createTime')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vitarian\ReceptyBundle\Entity\User',
            'createTime' => date("Y-m-d H:i:s")
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vitarian_receptybundle_user';
    }
}
