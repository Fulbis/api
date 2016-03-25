<?php
namespace Fulbis\V1\Rpc\TournamentsMatches;

class TournamentsMatchesControllerFactory
{
    public function __invoke($controllers)
    {
        $services = $controllers->getServiceLocator();
        return new TournamentsMatchesController($services->get(\Fulbis\Core\Service::class));
    }
}
