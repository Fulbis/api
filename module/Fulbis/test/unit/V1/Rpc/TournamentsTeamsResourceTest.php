<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class TournamentsTeamsResourceTest extends AbstractHttpControllerTestCase
{

    public function testResponseNoPlayers()
    {
        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments/1/teams'
                ]
            ],
            '_embedded' => [
                'teams' => []
            ],
            'total_items' => 0
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments/1/teams', 'GET')->content);
    }

    public function testResponseMultipleTeams()
    {

        $tournament = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament['id']])->content;
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament['id']])->content;

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments/' . $tournament['id'] . '/teams'
                ]
            ],
            '_embedded' => [
                'teams' => [
                    [
                        'id' => $team1['id'],
                        'name' => $team1['name'],
                        '_embedded' => [
                            'players' => [],
                            'tournament' =>  [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                                    ]
                                ]
                            ],
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/' . $team1['id']
                            ]
                        ]
                    ],
                    [
                        'id' => $team2['id'],
                        'name' => $team2['name'],
                        '_embedded' => [
                            'players' => [],
                            'tournament' =>  [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/tournaments/'.$tournament['id']
                                    ]
                                ]
                            ],
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/teams/' . $team2['id']
                            ]
                        ]
                    ]
                ]
            ],
            'total_items' => 2
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments/'.$tournament['id'].'/teams', 'GET')->content);
    }

}
