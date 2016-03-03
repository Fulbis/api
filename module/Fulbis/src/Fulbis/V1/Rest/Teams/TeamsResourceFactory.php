<?php
namespace Fulbis\V1\Rest\Teams;

class TeamsResourceFactory
{
    public function __invoke($services)
    {
        return new TeamsResource($services->get('Fulbis\Core\Service'));
    }
}
