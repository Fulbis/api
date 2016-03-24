<?php

namespace Fulbis\Core\Service;

class GenerateMatchesFactory
{
    public function __invoke($services)
    {
        return new GenerateMatches($services->get(\Fulbis\Core\Service::class));
    }
}
