<?php

namespace Fulbis\Test\V1\Rest;

use Fulbis\Test\AbstractHttpControllerTestCase;

class TournamentsResourseTest extends AbstractHttpControllerTestCase
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

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments'));
    }

    public function testResponseMultipleTournaments() {
        $tournament1 = new \Fulbis\Core\Entity\Tournament();
        $tournament1->setName('Premier League');

        $tournament2 = new \Fulbis\Core\Entity\Tournament();
        $tournament2->setName('La Liga');

        $this->entityManager->persist($tournament1);
        $this->entityManager->persist($tournament2);

        $this->entityManager->flush();

        $expectedResponse = [
            '_links' => [
                'self' => [
                    'href' => 'http://fulbis.dev/tournaments'
                ]
            ],
            '_embedded' => [
                'tournaments' => [
                    [
                        'id' => $tournament1->getId(),
                        'name' => $tournament1->getName(),
                        '_embedded' => [
                            'teams' => []
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/tournaments/'.$tournament1->getId()
                            ]
                        ]
                    ],
                    [
                        'id' => $tournament2->getId(),
                        'name' => $tournament2->getName(),
                        '_embedded' => [
                            'teams' => []
                        ],
                        '_links' => [
                            'self' => [
                                'href' => 'http://fulbis.dev/tournaments/'.$tournament2->getId()
                            ]
                        ]
                    ]
                ]
            ],
            'total_items' => 2
        ];

        $this->assertEquals($expectedResponse, $this->getArrayResponse('/tournaments'));
    }

}
