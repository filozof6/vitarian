<?php

namespace Vitarian\ReceptyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
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
                ->add('title')
                ->add('body')
                ->add('photo', 'file')
                ->add('category')
                ->add('ingredients', 'collection', array(
                    'type' => new PostIngredientsType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'label' => " ",
                    ))
        /*  ->add('id_author', 'hidden', array(
          "data" => $this->user)) */
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vitarian\ReceptyBundle\Entity\Post',
            'published' => date("Y-m-d H:i:s"),
            'author' => $this->user,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'vitarian_receptybundle_post';
    }

}
