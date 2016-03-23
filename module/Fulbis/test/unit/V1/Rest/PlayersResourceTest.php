<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class PlayersResourceTest extends AbstractHttpControllerTestCase
{

    public function testResponseNoPlayers()
    {
        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/players'
                ]
            ],
            '_embedded' => [
                'players' => []
            ],
            'total_items' => 0
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/players', 'GET')->content);
    }

    public function testResponseMultiplePlayers()
    {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']])->content;

        $player1 = $this->getArrayResponse('/players', 'POST', ['name' => 'Hazard', 'team' => $team['id']])->content;
        $player2 = $this->getArrayResponse('/players', 'POST', ['name' => 'Pedro', 'team' => $team['id']])->content;

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/players'
                ]
            ],
            '_embedded' => [
                'players' => [
                    [
                        'id' => $player1['id'],
                        'name' => $player1['name'],
                        '_embedded' => [
                            'team' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/' . $team['id']
                                    ]
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/players/' . $player1['id']
                            ]
                        ]
                    ],
                    [
                        'id' => $player2['id'],
                        'name' => $player2['name'],
                        '_embedded' => [
                            'team' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/' . $team['id']
                                    ]
                                ]
                            ]
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/players/' . $player2['id']
                            ]
                        ]
                    ]
                ]
            ],
            'total_items' => 2
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/players', 'GET')->content);
    }

    public function testResponseSinglePlayer() {
        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']])->content;

        $player = $this->getArrayResponse('/players', 'POST', ['name' => 'Hazard', 'team' => $team['id']])->content;

        $expectedResponse = [
            'id' => $player['id'],
            'name' => $player['name'],
            '_embedded' => [
                'team' => [
                    '_links' => [
                        'self' => [
                            'href' => 'http://fulbis.dev/teams/'.$team['id']
                        ]
                    ]
                ],
            ],
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/players/'.$player['id']
                ]
            ],
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/players/'.$player['id'], 'GET')->content);
    }

}
