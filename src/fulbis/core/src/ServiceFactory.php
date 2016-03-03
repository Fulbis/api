<?php
namespace Fulbis\Core;

class ServiceFactory
{
    public function __invoke($services)
    {
        return new Service(
                    $services->get('doctrine.entitymanager.orm_default'),
                    $services->get('Fulbis\Core\Hydrator')
        );
    }
}
