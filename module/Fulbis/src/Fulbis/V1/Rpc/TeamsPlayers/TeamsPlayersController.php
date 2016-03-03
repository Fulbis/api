<?php
namespace Fulbis\V1\Rpc\TeamsPlayers;

use Doctrine\ORM\QueryBuilder;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use Fulbis\Core\Service;

class TeamsPlayersController extends AbstractActionController
{

    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    public function teamsPlayersAction()
    {
        $teamId = $this->routeParam('team_id');

        $callback = function(QueryBuilder $queryBuilder) use ($teamId) {
            return $queryBuilder
                ->leftJoin('e.team', 't')
                ->where('t.id=:teamId')
                ->setParameter('teamId', $teamId);
        };

        $players = $this->service->fetchAll('Fulbis\Core\Entity\Player', $callback);

        $collection = new \ZF\Hal\Collection($players, 'fulbis.rest.players');
        $collection->setCollectionName('players');

        return new ViewModel(['payload' => $this->getPluginManager()->get('hal')->createCollection($collection, 'fulbis.rpc.teams-players')]);
    }

}
