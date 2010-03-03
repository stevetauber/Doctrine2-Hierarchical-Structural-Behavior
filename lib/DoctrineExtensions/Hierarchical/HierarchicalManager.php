<?php

namespace DoctrineExtensions\Hierarchical;

use DoctrineExtensions\Hierarchical\AdjacencyList\AdjacencyListNodeInfo,
    DoctrineExtensions\Hierarchical\AdjacencyList\AdjacencyListDecorator,
    DoctrineExtensions\Hierarchical\MaterializedPath\MaterializedPathNodeInfo,
    DoctrineExtensions\Hierarchical\MaterializedPath\MaterializedPathDecorator,
    DoctrineExtensions\Hierarchical\NestedSet\NestedSetNodeInfo,
    DoctrineExtensions\Hierarchical\NestedSet\NestedSetDecorator,
    DoctrineExtensions\Hierarchical\HierarchicalException,
    Doctrine\ORM\EntityManager;


class HierarchicalManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        return $this->em;
    }

    public function getNode($entity)
    {
        // Not yet implemented
        /*if ($entity instanceof AdjacencyListNodeInfo) {
            return new AdjacencyListDecorator($entity, $this);
        } else if ($entity instanceof MaterializedPathNodeInfo) {
            return new MaterializedPathDecorator($entity, $this);
        } else */
        if ($entity instanceof NestedSetNodeInfo) {
            return new NestedSetDecorator($entity, $this);
        }

        throw new HierarchicalException(
            'Provided entity does not implement any of the Hierarchical algorithms available. ' .
            'Are you sure ' . get_class($entity) . ' implements either ' .
            'AdjacencyListNodeInfo, MaterializedPathNodeInfo or NestedSetNodeInfo?'
        );
    }

    public function createRoot($entity)
    {
        if (!$entity instanceof Node) {
            $entity = $this->getNode($entity);
        }
        $entity->createRoot();
        return $entity;
    }

    // ...
}