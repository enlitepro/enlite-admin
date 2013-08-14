<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'admin-navigation' => 'EnliteAdmin\Navigation\Service\AdminNavigationFactory',
            'admin-entities' => 'EnliteAdmin\Entities\ContainerFactory'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'admin-index' => 'EnliteAdmin\Controller\IndexController',
            'admin-entity' => 'EnliteAdmin\Controller\EntityController',
        )
    ),
);