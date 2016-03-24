<?php
namespace Fulbis\V1\Rpc\CreateTournamentMatches;

class CreateTournamentMatchesControllerFactory
{
    public function __invoke($controllers)
    {
        $services = $controllers->getServiceLocator();
        return new CreateTournamentMatchesController(
            $services->get(\Fulbis\Core\Service::class),
            $services->get(\Fulbis\Core\FixtureGenerator::class),
            $services->get(\Fulbis\Core\Service\GenerateMatches::class),
            $services->get(\Fulbis\Core\Repository\Service\TournamentHasMatches::class)
        );
    }
}
