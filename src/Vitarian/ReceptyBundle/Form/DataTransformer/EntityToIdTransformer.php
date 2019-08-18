<?php

namespace Acme\TaskBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TaskBundle\Entity\Issue;

class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    private $entityName;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, string $entityName)
    {
        $this->om = $om;
        $this->entityName = $entityName;
        
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return "";
        }

        return $entity->getId();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $number
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $entity = $this->om
            ->getRepository('VitarianReceptyBundle:'.$this->entityName)
            ->findOneBy(array('id' => $id))
        ;

        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                'An entity (%s) with number "%s" does not exist!'
                ,$this->entityName,
                $id
            ));
        }

        return $entity;
    }
}
