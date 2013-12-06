<?php

return array(
    'assetic_configuration' => array(

        'modules' => array(
            /*
             * Application module - assets configuration
             */
            'EnliteAdmin' => array(

                # module root path for your css and js files
                'root_path' => realpath(__DIR__ . '/../assets'),
                # collection od assets
                'collections' => array(

                    'enlite_admin_css' => array(
                        'assets' => array(
                            'css/style.css'
                        ),
                        'filters' => array(
                            'CssImportFilter' => 'Assetic\Filter\CssImportFilter',
                            'CssRewriteFilter' => 'Assetic\Filter\CssRewriteFilter'
                        ),
                        'options' => array(
                            'output' => 'enlite/admin.*.css'
                        ),
                    ),
                    'enlite_admin_js' => array(
                        'assets' => array(
                            'js/jquery.min.js',
                            'js/bootstrap.min.js',
                        ),
                        'filters' => array(),
                        'options' => array(
                            'output' => 'enlite/admin.*.js'
                        ),
                    ),
                    'base_images' => array(
                        'assets' => array(
                            'fonts/**',
                        ),
                        'options' => array(
                            'move_raw' => true,
                        )
                    ),
                ),
            ),
        ),

        'routes' => array(
            'admin/?.*' => array(
                '@enlite_admin_js',
                '@enlite_admin_css',
            ),
        )
    )
);
