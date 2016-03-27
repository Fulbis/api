<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class MatchesResourceTest extends AbstractHttpControllerTestCase
{

    public function testResponseNoMatches()
    {
        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/matches'
                ]
            ],
            '_embedded' => [
                'matches' => []
            ],
            'total_items' => 0
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/matches', 'GET')->content);
    }

    public function testResponseMultipleMatches() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']])->content;
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']])->content;

        $match1 = $this->getArrayResponse('/matches', 'POST', ['team1' => $team1['id'], 'team2' => $team2['id']])->content;
        $match2 = $this->getArrayResponse('/matches', 'POST', ['team1' => $team2['id'], 'team2' => $team1['id']])->content;

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/matches'
                ]
            ],
            '_embedded' => [
                'matches' => [
                    [
                        'id' => $match1['id'],
                        '_embedded' => [
                            'team1' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/'.$team1['id']
                                    ]
                                ],
                                'id' => $team1['id'],
                                'name' => $team1['name'],
                                '_embedded' => [
                                    'players' => []
                                ]
                            ],
                            'team2' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/'.$team2['id']
                                    ]
                                ],
                                'id' => $team2['id'],
                                'name' => $team2['name'],
                                '_embedded' => [
                                    'players' => []
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/matches/'.$match1['id']
                            ]
                        ],
                        'game_number' => null
                    ],
                    [
                        'id' => $match2['id'],
                        '_embedded' => [
                            'team1' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/'.$team2['id']
                                    ]
                                ],
                                'id' => $team2['id'],
                                'name' => $team2['name'],
                                '_embedded' => [
                                    'players' => []
                                ]
                            ],
                            'team2' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/'.$team1['id']
                                    ]
                                ],
                                'id' => $team1['id'],
                                'name' => $team1['name'],
                                '_embedded' => [
                                    'players' => []
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/matches/'.$match2['id']
                            ]
                        ],
                        'game_number' => null
                    ],
                ]
            ],
            'total_items' => 2
        ];
        //var_dump($this->getArrayResponse('/matches', 'GET')->content);die();
        $this->assertEquals($expectedResponse, $this->getArrayResponse('/matches', 'GET')->content);
    }

    public function testResponseSingleMatch() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']])->content;
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']])->content;

        $match = $this->getArrayResponse('/matches', 'POST', ['team1' => $team1['id'], 'team2' => $team2['id']])->content;

        $expectedResponse = [
            'id' => $match['id'],
            '_embedded' => [
                'team1' => [
                    '_links' => [
                        'self' => [
                            'href' => 'http://fulbis.dev/teams/'.$team1['id']
                        ]
                    ],
                    'id' => $team1['id'],
                    'name' => $team1['name'],
                    '_embedded' => [
                        'players' => []
                    ]
                ],
                'team2' => [
                    '_links' => [
                        'self' => [
                            'href' => 'http://fulbis.dev/teams/'.$team2['id']
                        ]
                    ],
                    'id' => $team2['id'],
                    'name' => $team2['name'],
                    '_embedded' => [
                        'players' => []
                    ]
                ]
            ],
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/matches/'.$match['id']
                ]
            ],
            'game_number' => null
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/matches/'.$match['id'], 'GET')->content);
    }

    public function testRequiredFields() {
        $response = $this->getArrayResponse('/matches', 'POST', [])->content;

        $expectedErrors = ['team1', 'team2'];

        $this->assertEquals($expectedErrors, array_keys($response['validation_messages']));
    }

    public function testInvalidTeams() {
        $response = $this->getArrayResponse('/matches', 'POST', ['team1' => 'INVALID_ID', 'team2' => 'INVALID_ID'])->content;

        $this->assertArrayHasKey('noObjectFound', $response['validation_messages']['team1']);
        $this->assertArrayHasKey('noObjectFound', $response['validation_messages']['team2']);
    }

}
