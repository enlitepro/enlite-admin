<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\Entities;

use EnliteAdmin\Exception\RuntimeException;

class Container
{

    /**
     * @var Entity[]
     */
    protected $entities = array();

    /**
     * @param Entity $entity
     */
    public function addEntity(Entity $entity)
    {
        $this->entities[$entity->getName()] = $entity;
    }

    /**
     * Return value of Entities
     *
     * @return \EnliteAdmin\Entities\Entity[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param  string           $name
     * @throws RuntimeException
     *
     * @return Entity
     */
    public function getEntity($name)
    {
        if (!isset($this->entities[$name])) {
            throw new RuntimeException('Entity not found');
        }

        return $this->entities[$name];
    }

}
