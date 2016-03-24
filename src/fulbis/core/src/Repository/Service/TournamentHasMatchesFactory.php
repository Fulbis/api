<?php

namespace Fulbis\Core\Repository\Service;

class TournamentHasMatchesFactory
{
    public function __invoke($services)
    {
        return new TournamentHasMatches($services->get('doctrine.connection.orm_default'));
    }
}
