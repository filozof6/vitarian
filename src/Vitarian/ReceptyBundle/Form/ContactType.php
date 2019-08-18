<?php

namespace Vitarian\ReceptyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null,   array(
                                        'label'  => 'Title: ',
                                    ))
            ->add('name', null,   array(
                                        'label'  => 'Title: ',
                                    ))
            ->add('email', null,   array(
                                        'label'  => 'Title: ',
                                    ))
            ->add('body', null,   array(
                                        'label'  => 'Title: ',
                                    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vitarian\ReceptyBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vitarian_receptybundle_contact';
    }
}
