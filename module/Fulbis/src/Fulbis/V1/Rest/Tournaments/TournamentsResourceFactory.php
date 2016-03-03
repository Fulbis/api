<?php
namespace Fulbis\V1\Rest\Tournaments;

class TournamentsResourceFactory
{
    public function __invoke($services)
    {
        return new TournamentsResource($services->get('Fulbis\Core\Service'));
    }
}
