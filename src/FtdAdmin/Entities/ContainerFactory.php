<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace FtdAdmin\Entities;

use FtdAdmin\Configuration;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContainerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $container = new Container();
        /** @var Configuration $config */
        $config = $serviceLocator->get('admin-config');

        foreach ($config->getEntities() as $name => $options) {
            $entity = new Entity($name, $options);
            $entity->setServiceLocator($serviceLocator);
            $container->addEntity($entity);
        }

        return $container;
    }

}
