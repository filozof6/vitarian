<?php
namespace Acme\DemoBundle\Twig;

class CatalogExtension extends \Twig_Extension
{
    private $container;
    public function __construct($container)
    {
        $this->container = $container;
    } 
     public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('catalog', 'catalog'),
        );
    }

    public function catalog($entity, $name)
    {
        return null;
        
    }

    public function getName()
    {
        return 'catalog';
    }
}