<?php

namespace Fulbis\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

class Team
{

    private $id;

    private $name;

    private $players;

    private $tournament;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
        $this->players = new ArrayCollection;
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

    public function getPlayers() {
        return $this->players;
    }

    public function getTournament() {
        return $this->tournament;
    }

    public function setTournament(Tournament $tournament) {
        $this->tournament = $tournament;
    }

}