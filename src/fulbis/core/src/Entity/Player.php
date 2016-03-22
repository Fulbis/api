<?php

namespace Fulbis\Core\Entity;

use Ramsey\Uuid\Uuid;

class Player
{

    private $id;

    private $name;

    private $team;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
    }

    public function setId() {
        return $this->id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam(Team $team) {
        $this->team = $team;
    }

}