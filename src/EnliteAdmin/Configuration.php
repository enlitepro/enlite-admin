<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin;

use EnliteAdmin\Entities\EntityOptions;
use EnliteAdmin\Exception\RuntimeException;
use Zend\Stdlib\AbstractOptions;

class Configuration extends AbstractOptions
{

    /**
     * @var array
     */
    protected $entities = array();

    /**
     * @var bool
     */
    protected $enableNavigation = true;

    /**
     * The commands
     * ['name' => 'command']
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Set value of Entities
     *
     * @param  array $entities
     * @throws Exception\RuntimeException
     */
    public function setEntities($entities)
    {
        if (!is_array($entities)) {
            throw new RuntimeException('entities must be array');
        }

        $this->entities = array_map(
            function ($entity) {
                return new EntityOptions($entity);
            },
            $entities
        );
    }

    /**
     * Return value of Entities
     *
     * @return EntityOptions[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @param boolean $enableNavigation
     */
    public function setEnableNavigation($enableNavigation)
    {
        $this->enableNavigation = $enableNavigation;
    }

    /**
     * @return boolean
     */
    public function getEnableNavigation()
    {
        return $this->enableNavigation;
    }

    /**
     * @param array $commands
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

}
