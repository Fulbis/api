<?php
return [
    'doctrine' => array(
        'driver' => array(
            'db_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\XmlDriver',
                'paths' => array(
                    0 => __DIR__.'/../../src/fulbis/core/src/mapping',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Fulbis\\Core\\Entity' => 'db_driver',
                ),
            ),
        ),
        'connection' => array(
            'orm_default' => array(),
        ),
    ),
];