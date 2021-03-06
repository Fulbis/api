<?php
namespace Fulbis\Core\Hydrator;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Factory
{
    public function __invoke($services)
    {
        return new DoctrineHydrator($services->get('doctrine.entitymanager.orm_default'), false);
    }
}
