<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class TournamentsMatchesResourceTest extends AbstractHttpControllerTestCase
{

    public function testResponseNoMatches()
    {
        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments/1/matches'
                ]
            ],
            '_embedded' => [
                'matches' => []
            ],
            'total_items' => 0
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments/1/matches', 'GET')->content);
    }

    public function testResponseMultipleMatches() {
        $tournament1 = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'Premier League'])->content;

        $team1 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Arsenal', 'tournament' => $tournament1['id']])->content;
        $team2 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Chelsea', 'tournament' => $tournament1['id']])->content;

        $match1 = $this->getArrayResponse('/matches', 'POST', ['team1' => $team1['id'], 'team2' => $team2['id']])->content;
        $match2 = $this->getArrayResponse('/matches', 'POST', ['team1' => $team2['id'], 'team2' => $team1['id']])->content;

        // otro torneo
        $tournament2 = $this->getArrayResponse('/tournaments', 'POST', ['name' => 'La Liga'])->content;

        $team3 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Barcelona', 'tournament' => $tournament2['id']])->content;
        $team4 = $this->getArrayResponse('/teams', 'POST', ['name' => 'Real Madrid', 'tournament' => $tournament2['id']])->content;

        $match3 = $this->getArrayResponse('/matches', 'POST', ['team1' => $team3['id'], 'team2' => $team4['id']])->content;

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments/'.$tournament1['id'].'/matches'
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
                                ]
                            ],
                            'team2' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/'.$team2['id']
                                    ]
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
                                ]
                            ],
                            'team2' => [
                                '_links' => [
                                    'self' => [
                                        'href' => 'http://fulbis.dev/teams/'.$team1['id']
                                    ]
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

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments/'.$tournament1['id'].'/matches', 'GET')->content);
    }

}
