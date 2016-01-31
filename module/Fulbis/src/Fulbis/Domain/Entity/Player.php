<?php

namespace Fulbis\Domain\Entity;

use Ramsey\Uuid\Uuid;

class Player implements VersionableInterface
{

    private $id_auto;

    private $id;

    private $deleted = 0;

    private $name;

    public function __construct() {
        $this->id = Uuid::uuid4()->toString();
    }

    public function setIdAuto($id) {
        $this->id_auto = $id;
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

}