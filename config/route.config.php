<?php

return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'admin-index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'entity' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/entity',
                            'defaults' => array(
                                'controller' => 'admin-entity',
                                'action' => 'index',
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'entity' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '/:entity[/page/:page]',
                                    'defaults' => array(
                                        'action' => 'list',
                                        'page' => 1
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'remove' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/remove',
                                            'defaults' => array(
                                                'action' => 'remove'
                                            )
                                        ),
                                    ),
                                    'create' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/create',
                                            'defaults' => array(
                                                'action' => 'create'
                                            )
                                        ),
                                    ),
                                    'edit' => array(
                                        'type' => 'segment',
                                        'options' => array(
                                            'route' => '/edit/:id',
                                            'defaults' => array(
                                                'action' => 'edit'
                                            )
                                        ),
                                    )
                                )
                            ),
                        )
                    )
                )
            ),
        ),
    )
);
