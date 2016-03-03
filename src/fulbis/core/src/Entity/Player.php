<?php

namespace Fulbis\Core\Entity;

use Ramsey\Uuid\Uuid;

class Player implements VersionableInterface
{

    private $id_auto;

    private $id;

    private $deleted = 0;

    private $name;

    private $team;

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