<?php
namespace Fulbis\V1\Rpc\TeamsPlayers;

class TeamsPlayersControllerFactory
{
    public function __invoke($controllers)
    {
        $services = $controllers->getServiceLocator();
        return new TeamsPlayersController($services->get(\Fulbis\Core\Service::class));
    }
}
