<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\ACL\Provider;


use BjyAuthorize\Service\Authorize;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BjyAuthorize implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var Authorize $auth */
        $auth = $serviceLocator->get('BjyAuthorize\Service\Authorize');
        return $auth->getAcl();

    }
}