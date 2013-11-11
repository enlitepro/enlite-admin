<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'EnliteAdminNavigation' => 'EnliteAdmin\Navigation\Service\AdminNavigationFactory',
            'EnliteAdminEntities' => 'EnliteAdmin\Entities\ContainerFactory'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'EnliteAdminIndex' => 'EnliteAdmin\Controller\IndexController',
            'EnliteAdminEntity' => 'EnliteAdmin\Controller\EntityController',
            'EnliteAdminACL' => 'Admin\Controller\ACLController'
        )
    ),
);