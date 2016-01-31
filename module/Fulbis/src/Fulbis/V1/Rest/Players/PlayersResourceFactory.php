<?php
namespace Fulbis\V1\Rest\Players;

class PlayersResourceFactory
{
    public function __invoke($services)
    {
        return new PlayersResource($services->get('Fulbis\Domain\Service'));
    }
}
