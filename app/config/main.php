<?php

return array(

    'defaultController' => 'Home',

    // Just put null value if you has enable .htaccess file
    'indexFile' => '',

    'module' => array(
        'path' => APP,
        'domainMapping' => array(),
    ),

    'vendor' => array(
        'path' => APP.'vendor/'
    ),

    'alias' => array(
        /*
        'controller' => array(
            'class' => 'Alias',
            'method' => 'index'
        ),
        */
        'method' => 'alias'
    ),
);
