<?php
namespace Fulbis\V1\Rpc\TournamentsTeams;

class TournamentsTeamsControllerFactory
{
    public function __invoke($controllers)
    {
        $services = $controllers->getServiceLocator();
        return new TournamentsTeamsController($services->get(\Fulbis\Core\Service::class));
    }
}
