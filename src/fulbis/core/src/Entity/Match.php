<?php

namespace Fulbis\Core\Entity;

use Ramsey\Uuid\Uuid;

class Match
{

    private $id;

    /**
     * @var Team
     */
    private $team1;

    /**
     * @var Team
     */
    private $team2;

    private $gameNumber;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
    }

    public function setId() {
        return $this->id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTeam1() {
        return $this->team1;
    }

    public function setTeam1(Team $team1) {
        $this->team1 = $team1;
    }

    public function getTeam2() {
        return $this->team2;
    }

    public function setTeam2(Team $team2) {
        $this->team2 = $team2;
    }

    public function setGameNumber() {
        return $this->gameNumber;
    }

    public function getGameNumber() {
        return $this->gameNumber;
    }

}