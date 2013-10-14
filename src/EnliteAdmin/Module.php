<?php

namespace EnliteAdmin;

use EnliteAdmin\Service\EntityService;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

class Module implements ConfigProviderInterface, ServiceProviderInterface, AutoloaderProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return array_merge(
            include __DIR__ . '/../../config/module.config.php',
            include __DIR__ . '/../../config/auth.config.php',
            include __DIR__ . '/../../config/navigation.config.php',
            include __DIR__ . '/../../config/route.config.php',
            include __DIR__ . '/../../config/assetic.config.php',
            include __DIR__ . '/../../config/service.config.php'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'EnliteAdminConfiguration' => function (ServiceManager $sm) {
                    $config = $sm->get('Config');

                    return new Configuration($config['admin']);
                },
                'EnliteAdminEntityService' => function (ServiceManager $sm) {
                    return new EntityService($sm);
                }
            )
        );
    }

}
