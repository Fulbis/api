<?php

namespace Fulbis\Domain\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\Common\Collections\ArrayCollection;

class Tournament implements VersionableInterface
{

    private $id_auto;

    private $id;

    private $deleted = 0;

    private $name;

    private $teams;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
        $this->teams = new ArrayCollection;
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

    public function getTeams() {
        return $this->teams;
    }

}