<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class TournamentsResourceTest extends AbstractHttpControllerTestCase
{

    public function testResponseNoTournaments()
    {
        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments'
                ]
            ],
            '_embedded' => [
                'tournaments' => []
            ],
            'total_items' => 0
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments', 'GET')->content);
    }

    public function testResponseMultipleTournaments() {
        $tournament1 = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;
        $tournament2 = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'La Liga'])->content;

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments'
                ]
            ],
            '_embedded' => [
                'tournaments' => [
                    [
                        'id' => $tournament1['id'],
                        'name' => $tournament1['name'],
                        '_embedded' => [
                            'teams' => []
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/tournaments/'.$tournament1['id']
                            ]
                        ]
                    ],
                    [
                        'id' => $tournament2['id'],
                        'name' => $tournament2['name'],
                        '_embedded' => [
                            'teams' => []
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/tournaments/'.$tournament2['id']
                            ]
                        ]
                    ]
                ]
            ],
            'total_items' => 2
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments', 'GET')->content);
    }

    public function testResponseTournamentsWithTeams() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']])->content;
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']])->content;

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments'
                ]
            ],
            '_embedded' => [
                'tournaments' => [
                    [
                        'id' => $tournament['id'],
                        'name' => $tournament['name'],
                        '_embedded' => [
                            'teams' => [
                                [
                                    '_links' => [
                                        'self' => [
                                            'href' => 'http://fulbis.dev/teams/'.$team1['id']
                                        ]
                                    ]
                                ],
                                [
                                    '_links' => [
                                        'self' => [
                                            'href' => 'http://fulbis.dev/teams/'.$team2['id']
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                            ]
                        ]
                    ],
                ]
            ],
            'total_items' => 1
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments', 'GET')->content);
    }

    public function testResponseSingleTournamentWithTeams() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']])->content;
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']])->content;

        $expectedResponse = [
            'id' => $tournament['id'],
            'name' => $tournament['name'],
            '_embedded' => [
                'teams' => [
                    [
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/'.$team1['id']
                            ]
                        ]
                    ],
                    [
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/'.$team2['id']
                            ]
                        ]
                    ]
                ]
            ],
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                ]
            ],
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments/'.$tournament['id'], 'GET')->content);
    }

    public function testRequiredFields() {
        $response = $this->getArrayResponse('/tournaments', 'POST', [])->content;

        $expectedErrors = ['name'];

        $this->assertEquals($expectedErrors, array_keys($response['validation_messages']));
    }

}
