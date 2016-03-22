<?php

namespace Fulbis\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;

class Tournament
{

    private $id;

    private $name;

    private $teams;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
        $this->teams = new ArrayCollection;
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

    public function getTeams() {
        return $this->teams;
    }

}