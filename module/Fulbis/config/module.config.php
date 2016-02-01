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
            'Fulbis\\V1\\Rest\\Teams\\TeamsResource' => 'Fulbis\\V1\\Rest\\Teams\\TeamsResourceFactory',
            'Fulbis\\V1\\Rest\\Tournaments\\TournamentsResource' => 'Fulbis\\V1\\Rest\\Tournaments\\TournamentsResourceFactory',
            'Fulbis\\V1\\Rest\\Matches\\MatchesResource' => 'Fulbis\\V1\\Rest\\Matches\\MatchesResourceFactory',
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
            'fulbis.rest.teams' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/teams[/:teams_id]',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rest\\Teams\\Controller',
                    ),
                ),
            ),
            'fulbis.rest.tournaments' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tournaments[/:tournaments_id]',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rest\\Tournaments\\Controller',
                    ),
                ),
            ),
            'fulbis.rest.matches' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/matches[/:matches_id]',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rest\\Matches\\Controller',
                    ),
                ),
            ),
            'fulbis.rpc.teams-players' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/teams/:team_id/players',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller',
                        'action' => 'teamsPlayers',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'fulbis.rest.players',
            1 => 'fulbis.rest.teams',
            2 => 'fulbis.rest.tournaments',
            3 => 'fulbis.rest.matches',
            4 => 'fulbis.rpc.teams-players',
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
        'Fulbis\\V1\\Rest\\Teams\\Controller' => array(
            'listener' => 'Fulbis\\V1\\Rest\\Teams\\TeamsResource',
            'route_name' => 'fulbis.rest.teams',
            'route_identifier_name' => 'teams_id',
            'collection_name' => 'teams',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Fulbis\\Domain\\Entity\\Team',
            'collection_class' => 'Fulbis\\V1\\Rest\\Teams\\TeamsCollection',
            'service_name' => 'Teams',
        ),
        'Fulbis\\V1\\Rest\\Tournaments\\Controller' => array(
            'listener' => 'Fulbis\\V1\\Rest\\Tournaments\\TournamentsResource',
            'route_name' => 'fulbis.rest.tournaments',
            'route_identifier_name' => 'tournaments_id',
            'collection_name' => 'tournaments',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Fulbis\\Domain\\Entity\\Tournament',
            'collection_class' => 'Fulbis\\V1\\Rest\\Tournaments\\TournamentsCollection',
            'service_name' => 'Tournaments',
        ),
        'Fulbis\\V1\\Rest\\Matches\\Controller' => array(
            'listener' => 'Fulbis\\V1\\Rest\\Matches\\MatchesResource',
            'route_name' => 'fulbis.rest.matches',
            'route_identifier_name' => 'matches_id',
            'collection_name' => 'matches',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PUT',
                2 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Fulbis\\Domain\\Entity\\Match',
            'collection_class' => 'Fulbis\\V1\\Rest\\Matches\\MatchesCollection',
            'service_name' => 'Matches',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Fulbis\\V1\\Rest\\Players\\Controller' => 'HalJson',
            'Fulbis\\V1\\Rest\\Teams\\Controller' => 'HalJson',
            'Fulbis\\V1\\Rest\\Tournaments\\Controller' => 'HalJson',
            'Fulbis\\V1\\Rest\\Matches\\Controller' => 'HalJson',
            'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Fulbis\\V1\\Rest\\Players\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Fulbis\\V1\\Rest\\Teams\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Fulbis\\V1\\Rest\\Tournaments\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Fulbis\\V1\\Rest\\Matches\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
        ),
        'content_type_whitelist' => array(
            'Fulbis\\V1\\Rest\\Players\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
            'Fulbis\\V1\\Rest\\Teams\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
            'Fulbis\\V1\\Rest\\Tournaments\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
            'Fulbis\\V1\\Rest\\Matches\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
            'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller' => array(
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
            'Fulbis\\V1\\Rest\\Teams\\TeamsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.teams',
                'route_identifier_name' => 'teams_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Fulbis\\V1\\Rest\\Teams\\TeamsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.teams',
                'route_identifier_name' => 'teams_id',
                'is_collection' => true,
            ),
            'Fulbis\\Domain\\Entity\\Teams' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.teams',
                'route_identifier_name' => 'teams_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Fulbis\\Domain\\Entity\\Team' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.teams',
                'route_identifier_name' => 'teams_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
            'Fulbis\\V1\\Rest\\Tournaments\\TournamentsEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.tournaments',
                'route_identifier_name' => 'tournaments_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Fulbis\\V1\\Rest\\Tournaments\\TournamentsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.tournaments',
                'route_identifier_name' => 'tournaments_id',
                'is_collection' => true,
            ),
            'Fulbis\\Domain\\Entity\\Tournament' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.tournaments',
                'route_identifier_name' => 'tournaments_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
            ),
            'Fulbis\\V1\\Rest\\Matches\\MatchesEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.matches',
                'route_identifier_name' => 'matches_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Fulbis\\V1\\Rest\\Matches\\MatchesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.matches',
                'route_identifier_name' => 'matches_id',
                'is_collection' => true,
            ),
            'Fulbis\\Domain\\Entity\\Match' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.matches',
                'route_identifier_name' => 'matches_id',
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
        'Fulbis\\V1\\Rest\\Teams\\Controller' => array(
            'input_filter' => 'Fulbis\\V1\\Rest\\Teams\\Validator',
        ),
        'Fulbis\\V1\\Rest\\Tournaments\\Controller' => array(
            'input_filter' => 'Fulbis\\V1\\Rest\\Tournaments\\Validator',
        ),
        'Fulbis\\V1\\Rest\\Matches\\Controller' => array(
            'input_filter' => 'Fulbis\\V1\\Rest\\Matches\\Validator',
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
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'team',
            ),
        ),
        'Fulbis\\V1\\Rest\\Teams\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'tournament',
            ),
        ),
        'Fulbis\\V1\\Rest\\Tournaments\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'name',
            ),
        ),
        'Fulbis\\V1\\Rest\\Matches\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'team1',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'team2',
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller' => 'Fulbis\\V1\\Rpc\\TeamsPlayers\\TeamsPlayersControllerFactory',
        ),
    ),
    'zf-rpc' => array(
        'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller' => array(
            'service_name' => 'TeamsPlayers',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'fulbis.rpc.teams-players',
        ),
    ),
);
