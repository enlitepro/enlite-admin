<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\Entities;

use EnliteAdmin\Exception\RuntimeException;
use EnliteAdmin\Service\DefaultEntityService;
use EnliteAdmin\Service\EntityServiceInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Entity
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var EntityOptions
     */
    protected $options;

    /**
     * @var EntityServiceInterface
     */
    protected $service;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * The title
     *
     * @var string
     */
    protected $title;

    /**
     * @param string        $name
     * @param EntityOptions $options
     */
    public function __construct($name, $options)
    {
        $this->name = $name;
        $this->options = $options;
    }

    /**
     * Return value of Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return value of Options
     *
     * @return \EnliteAdmin\Entities\EntityOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Return value of Service
     *
     * @throws \EnliteAdmin\Exception\RuntimeException
     * @return \EnliteAdmin\Service\EntityServiceInterface
     */
    public function getService()
    {
        if (null == $this->service) {
            $service = $this->getOptions()->getService();

            if ($service) {
                if ($this->getServiceLocator()->has($service)) {
                    $this->service = $this->getServiceLocator()->get($service);
                } elseif (class_exists($service)) {
                    $this->service = new $service($this->getServiceLocator());
                } else {
                    throw new RuntimeException('Cannot create service (' . $service . ')');
                }
            } else {
                $this->service = new DefaultEntityService($this, $this->getServiceLocator());
            }
        }

        return $this->service;
    }

    /**
     * Set value of Service
     *
     * @param \EnliteAdmin\Service\EntityServiceInterface $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * Set value of ServiceLocator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Return value of ServiceLocator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->getOptions()->getEntity();
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        if (is_null($this->title)) {
            $options = $this->getOptions();
            if (!is_null($options->getTitle())) {
                $this->title = $options->getTitle();
            } else {
                $this->title = $this->getName();
            }
        }
        return $this->title;
    }

}

