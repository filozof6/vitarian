<?php

namespace Vitarian\ReceptyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CtLinksType extends AbstractType
{

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', null, array(
                    'label' => 'Name: ',
                ))
                ->add('description', null, array(
                    'label' => 'Description: ',
                ))
                ->add('url', "url", array(
                    'label' => 'Url: ',
                ))
                ->add('category')
                ->add('geo', new GeoType($this->user), array(
                    "required" => false,
                    "label" =>"Map marker",
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vitarian\ReceptyBundle\Entity\CtLinks',
            'id_author' => $this->user,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vitarian_receptybundle_ctlinks';
    }

}
