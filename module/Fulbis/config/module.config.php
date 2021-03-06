<?php
return array(
    'service_manager' => array(
        'abstract_factories' => array(
            0 => 'Fulbis\\Core\\Repository\\AbstractFactory',
        ),
        'invokables' => array(
            'Fulbis\\Core\\FixtureGenerator' => 'Fulbis\\Core\\FixtureGenerator',
        ),
        'factories' => array(
            'Fulbis\\V1\\Rest\\Players\\PlayersResource' => 'Fulbis\\V1\\Rest\\Players\\PlayersResourceFactory',
            'Fulbis\\Core\\Hydrator' => 'Fulbis\\Core\\Hydrator\\Factory',
            'Fulbis\\Core\\Service' => 'Fulbis\\Core\\ServiceFactory',
            'Fulbis\\Core\\Service\\GenerateMatches' => 'Fulbis\\Core\\Service\\GenerateMatchesFactory',
            'Fulbis\\Core\\Repository\\Service\\TournamentHasMatches' => 'Fulbis\\Core\\Repository\\Service\\TournamentHasMatchesFactory',
            'Fulbis\\V1\\Rest\\Teams\\TeamsResource' => 'Fulbis\\V1\\Rest\\Teams\\TeamsResourceFactory',
            'Fulbis\\V1\\Rest\\Tournaments\\TournamentsResource' => 'Fulbis\\V1\\Rest\\Tournaments\\TournamentsResourceFactory',
            'Fulbis\\V1\\Rest\\Matches\\MatchesResource' => 'Fulbis\\V1\\Rest\\Matches\\MatchesResourceFactory',
        ),
    ),
    'hydrators' => array(
        'invokables' => array(
            'Fulbis\\Hydrator\\Team' => 'Fulbis\\Hydrator\\Team'
        ),
    ),
    'validators' => array(
        'factories' => array(
            'Fulbis\\Validator\\Doctrine\\ObjectExists' => 'Fulbis\\Validator\\Doctrine\\ObjectExistsFactory',
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
            'fulbis.rpc.tournaments-teams' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tournaments/:tournament_id/teams',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rpc\\TournamentsTeams\\Controller',
                        'action' => 'tournamentsTeams',
                    ),
                ),
            ),
            'fulbis.rpc.create-tournament-matches' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tournaments/:tournament_id/matches/generate',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\Controller',
                        'action' => 'createTournamentMatches',
                    ),
                ),
            ),
            'fulbis.rpc.tournaments-matches' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tournaments/:tournament_id/matches',
                    'defaults' => array(
                        'controller' => 'Fulbis\\V1\\Rpc\\TournamentsMatches\\Controller',
                        'action' => 'tournamentsMatches',
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
            5 => 'fulbis.rpc.tournaments-teams',
            6 => 'fulbis.rpc.create-tournament-matches',
            7 => 'fulbis.rpc.tournaments-matches',
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
            'entity_class' => 'Fulbis\\Core\\Entity\\Player',
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
            'entity_class' => 'Fulbis\\Core\\Entity\\Team',
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
            'entity_class' => 'Fulbis\\Core\\Entity\\Tournament',
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
            'entity_class' => 'Fulbis\\Core\\Entity\\Match',
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
            'Fulbis\\V1\\Rpc\\TournamentsTeams\\Controller' => 'HalJson',
            'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\Controller' => 'HalJson',
            'Fulbis\\V1\\Rpc\\TournamentsMatches\\Controller' => 'HalJson',
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
            'Fulbis\\V1\\Rpc\\TournamentsTeams\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ),
            'Fulbis\\V1\\Rpc\\TournamentsMatches\\Controller' => array(
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
            'Fulbis\\V1\\Rpc\\TournamentsTeams\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
            'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
            'Fulbis\\V1\\Rpc\\TournamentsMatches\\Controller' => array(
                0 => 'application/vnd.fulbis.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Doctrine\\ORM\\PersistentCollection' => array(
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
                'isCollection' => true,
                'max_depth' => 0,
            ),
            'Fulbis\\V1\\Rest\\Players\\PlayersCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.players',
                'route_identifier_name' => 'players_id',
                'is_collection' => true,
                'max_depth' => 0,
            ),
            'Fulbis\\Core\\Entity\\Player' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.players',
                'route_identifier_name' => 'players_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
                'max_depth' => 0,
            ),
            'Fulbis\\V1\\Rest\\Teams\\TeamsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.teams',
                'route_identifier_name' => 'teams_id',
                'is_collection' => true,
                'max_depth' => 0,
            ),
            'Fulbis\\Core\\Entity\\Team' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.teams',
                'route_identifier_name' => 'teams_id',
                'hydrator' => 'Fulbis\\Hydrator\\Team',
                'max_depth' => 0,
            ),
            'Fulbis\\V1\\Rest\\Tournaments\\TournamentsCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.tournaments',
                'route_identifier_name' => 'tournaments_id',
                'is_collection' => true,
                'max_depth' => 0,
            ),
            'Fulbis\\Core\\Entity\\Tournament' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.tournaments',
                'route_identifier_name' => 'tournaments_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
                'max_depth' => 0,
            ),
            'Fulbis\\V1\\Rest\\Matches\\MatchesCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.matches',
                'route_identifier_name' => 'matches_id',
                'is_collection' => true,
                'max_depth' => 1,
            ),
            'Fulbis\\Core\\Entity\\Match' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'fulbis.rest.matches',
                'route_identifier_name' => 'matches_id',
                'hydrator' => 'Zend\\Hydrator\\ClassMethods',
                'max_depth' => 1,
            ),
        ),
        'renderer' => array(
            'render_embedded_entities' => true,
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
                'validators' => array(
                    0 => array(
                        'name' => 'Fulbis\\Validator\\Doctrine\\ObjectExists',
                        'options' => array(
                            'fields' => 'id',
                            'entity' => 'Fulbis\\Core\\Entity\\Team',
                        ),
                    ),
                ),
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
                'validators' => array(
                    0 => array(
                        'name' => 'Fulbis\\Validator\\Doctrine\\ObjectExists',
                        'options' => array(
                            'fields' => 'id',
                            'entity' => 'Fulbis\\Core\\Entity\\Tournament',
                        ),
                    ),
                ),
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
                'validators' => array(
                    0 => array(
                        'name' => 'Fulbis\\Validator\\Doctrine\\ObjectExists',
                        'options' => array(
                            'fields' => 'id',
                            'entity' => 'Fulbis\\Core\\Entity\\Team',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'team1',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Fulbis\\Validator\\Doctrine\\ObjectExists',
                        'options' => array(
                            'fields' => 'id',
                            'entity' => 'Fulbis\\Core\\Entity\\Team',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'team2',
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Fulbis\\V1\\Rpc\\TeamsPlayers\\Controller' => 'Fulbis\\V1\\Rpc\\TeamsPlayers\\TeamsPlayersControllerFactory',
            'Fulbis\\V1\\Rpc\\TournamentsTeams\\Controller' => 'Fulbis\\V1\\Rpc\\TournamentsTeams\\TournamentsTeamsControllerFactory',
            'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\Controller' => 'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\CreateTournamentMatchesControllerFactory',
            'Fulbis\\V1\\Rpc\\TournamentsMatches\\Controller' => 'Fulbis\\V1\\Rpc\\TournamentsMatches\\TournamentsMatchesControllerFactory',
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
        'Fulbis\\V1\\Rpc\\TournamentsTeams\\Controller' => array(
            'service_name' => 'TournamentsTeams',
            'http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'route_name' => 'fulbis.rpc.tournaments-teams',
        ),
        'Fulbis\\V1\\Rpc\\CreateTournamentMatches\\Controller' => array(
            'service_name' => 'CreateTournamentMatches',
            'http_methods' => array(
                0 => 'POST',
            ),
            'route_name' => 'fulbis.rpc.create-tournament-matches',
        ),
        'Fulbis\\V1\\Rpc\\TournamentsMatches\\Controller' => array(
            'service_name' => 'TournamentsMatches',
            'http_methods' => array(
                0 => 'GET',
            ),
            'route_name' => 'fulbis.rpc.tournaments-matches',
        ),
    ),
);
