<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class TeamsResourceTest extends AbstractHttpControllerTestCase
{

    public function testResponseNoTeams()
    {
        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/teams'
                ]
            ],
            '_embedded' => [
                'teams' => []
            ],
            'total_items' => 0
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/teams', 'GET'));
    }

    public function testResponseMultipleTeams() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League']);

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']]);
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']]);

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/teams'
                ]
            ],
            '_embedded' => [
                'teams' => [
                    [
                        'id' => $team1['id'],
                        'name' => $team1['name'],
                        '_embedded' => [
                            'players' => [],
                            'tournament' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                                    ]
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/'.$team1['id']
                            ]
                        ]
                    ],
                    [
                        'id' => $team2['id'],
                        'name' => $team2['name'],
                        '_embedded' => [
                            'players' => [],
                            'tournament' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                                    ]
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/'.$team2['id']
                            ]
                        ]
                    ]
                ]
            ],
            'total_items' => 2
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/teams', 'GET'));
    }

    public function testResponseTeamWithPlayers() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League']);

        $team = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']]);

        $player1 = $this->getArrayResponse('/players', 'POST', ['name' => 'Hazard', 'team' => $team['id']]);
        $player2 = $this->getArrayResponse('/players', 'POST', ['name' => 'Pedro', 'team' => $team['id']]);

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/teams'
                ]
            ],
            '_embedded' => [
                'teams' => [
                    [
                        'id' => $team['id'],
                        'name' => $team['name'],
                        '_embedded' => [
                            'players' => [
                                [
                                    '_links' => [
                                        'self' => [
                                            'href' => 'http://fulbis.dev/players/'.$player1['id']
                                        ]
                                    ]
                                ],
                                [
                                    '_links' => [
                                        'self' => [
                                            'href' => 'http://fulbis.dev/players/'.$player2['id']
                                        ]
                                    ]
                                ]
                            ],
                            'tournament' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                                    ]
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/'.$team['id']
                            ]
                        ]
                    ],
                ]
            ],
            'total_items' => 1
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/teams', 'GET'));
    }

    public function testResponseSingleTeamWithPlayers() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League']);

        $team = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']]);

        $player1 = $this->getArrayResponse('/players', 'POST', ['name' => 'Hazard', 'team' => $team['id']]);
        $player2 = $this->getArrayResponse('/players', 'POST', ['name' => 'Pedro', 'team' => $team['id']]);

        $expectedResponse = [
            'id' => $team['id'],
            'name' => $team['name'],
            '_embedded' => [
                'players' => [
                    [
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/players/'.$player1['id']
                            ]
                        ]
                    ],
                    [
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/players/'.$player2['id']
                            ]
                        ]
                    ]
                ],
                'tournament' => [
                    '_links' => [
                        'self' => [
                            'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                        ]
                    ]
                ]
            ],
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/teams/'.$team['id']
                ]
            ],
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/teams/'.$team['id'], 'GET'));
    }

}
