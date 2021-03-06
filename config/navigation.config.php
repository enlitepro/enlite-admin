<?php

return array(
    'navigation' => array(
        'default' => array(
            'admin' => array(
                'label' => 'Admin',
                'route' => 'admin',
                'resource' => 'admin'
            )
        ),
        'admin' => array(
            'main' => array(
                'label' => 'Main page',
                'route' => 'admin',
                'resource' => 'admin'
            ),
            'acl' => array(
                'label' => 'ACL',
                'route' => 'admin/acl',
                'resource' => 'admin'
            ),
            'commands' => array(
                'label' => 'Commands',
                'route' => 'admin/commands',
                'resource' => 'admin'
            )
        )
    )
);
