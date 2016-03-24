<?php

namespace Fulbis\Core\Service;

use Fulbis\Core\Entity\Tournament;
use Fulbis\Core\Service;

class GenerateMatches {

    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    public function generate(array $fixture) {

        foreach($fixture as $gameNumber => $matches) {

            foreach($matches as $teams) {
                $data = [
                        'gameNumber' => $gameNumber,
                        'team1' => $teams[0],
                        'team2' => $teams[1]
                ];
                $this->service->create(\Fulbis\Core\Entity\Match::class, $data);
            }

        }

    }

}