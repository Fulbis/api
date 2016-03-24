<?php
namespace Fulbis\V1\Rest\Matches;

class MatchesResourceFactory
{
    public function __invoke($services)
    {
        return new MatchesResource($services->get(\Fulbis\Core\Service::class));
    }
}
