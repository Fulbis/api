<?php

namespace Fulbis\Domain\Entity;

use Ramsey\Uuid\Uuid;

class Match implements VersionableInterface
{

    private $id_auto;

    private $id;

    private $deleted = 0;

    private $team1;

    private $team2;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
    }

    public function setIdAuto($id) {
        $this->id_auto = $id;
    }

    public function getIdAuto() {
        return $this->id_auto;
    }

    public function getId() {
        return $this->id;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
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

}