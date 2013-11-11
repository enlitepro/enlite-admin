<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'EnliteAdminNavigation' => 'EnliteAdmin\Navigation\Service\AdminNavigationFactory',
            'EnliteAdminEntities' => 'EnliteAdmin\Entities\ContainerFactory',
            'EnliteAdminACLProvider' => 'EnliteAdmin\ACL\Provider\BjyAuthorize',
            'EnliteAdminACLFilterForm' => 'EnliteAdmin\Form\ACLFilterFormFactory'
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'EnliteAdminIndex' => 'EnliteAdmin\Controller\IndexController',
            'EnliteAdminEntity' => 'EnliteAdmin\Controller\EntityController',
            'EnliteAdminACL' => 'EnliteAdmin\Controller\ACLController'
        )
    ),
);