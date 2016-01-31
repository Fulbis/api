<?php
return array(
    'service_manager' => array(
        'abstract_factories' => array(
            0 => 'Fulbis\\Domain\\Repository\\AbstractFactory',
        ),
        'factories' => array(
            'Fulbis\\V1\\Rest\\Players\\PlayersResource' => 'Fulbis\\V1\\Rest\\Players\\PlayersResourceFactory',
            'Fulbis\\Domain\\Hydrator' => 'Fulbis\\Domain\\Hydrator\\Factory',
            'Fulbis\\Domain\\Service' => 'Fulbis\\Domain\\ServiceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'fulbis.rest.players' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/players[/:players_id]',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rest\\Players\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'fulbis.rest.players',
        ),
    ),
    'zf-rest' => array(
        'Fulbis\\V1\\Rest\\Players\\Controller' => array(
            'listener' => 'Fulbis\\V1\\Rest\\Players\\PlayersResource',
            'route_name' => 'fulbis.rest.players',
            'route_identifier_name' => 'players_id',
            'collection_name' => 'players',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'POST',
                1 => 'GET',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Fulbis\\Domain\\Entity\\Player',
            'collection_class' => 'Fulbis\\V1\\Rest\\Players\\PlayersCollection',
            'service_name' => 'Players',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Fulbis\\V1\\Rest\\Players\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Fulbis\\V1\\Rest\\Players\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Fulbis\\V1\\Rest\\Players\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Fulbis\\V1\\Rest\\Players\\PlayersEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.players',
                'route_identifier_name' => 'players_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Fulbis\\V1\\Rest\\Players\\PlayersCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.players',
                'route_identifier_name' => 'players_id',
                'is_collection' => true,
            ),
            'Fulbis\\Domain\\Entity\\Player' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.players',
                'route_identifier_name' => 'players_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'db_driver' => array(
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\XmlDriver',
                'paths' => array(
                    0 => 'D:\\xampp\\htdocs\\fulbis-api\\module\\Fulbis\\config/../src/Fulbis/Domain/mapping',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Fulbis\\Domain\\Entity' => 'db_driver',
                ),
            ),
        ),
        'connection' => array(
            'orm_default' => array(),
        ),
    ),
    'zf-content-validation' => array(
        'Fulbis\\V1\\Rest\\Players\\Controller' => array(
            'input_filter' => 'Fulbis\\V1\\Rest\\Players\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Fulbis\\V1\\Rest\\Players\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
            ),
        ),
    ),
);
