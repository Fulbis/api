<?php
namespace Fulbis\V1\Rpc\TournamentsTeams;

use Doctrine\ORM\QueryBuilder;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use Fulbis\Core\Service;

class TournamentsTeamsController extends AbstractActionController
{

    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    public function tournamentsTeamsAction()
    {
        $tournamentId = $this->routeParam('tournament_id');

        $callback = function(QueryBuilder $queryBuilder) use ($tournamentId) {
            return $queryBuilder
                ->leftJoin('e.tournament', 't')
                ->where('t.id=:tournamentId')
                ->setParameter('tournamentId', $tournamentId);
        };

        $players = $this->service->fetchAll(\Fulbis\Core\Entity\Team::class, $callback);

        $collection = new \ZF\Hal\Collection($players, 'fulbis.rest.teams');
        $collection->setCollectionName('teams');

        return new ViewModel(['payload' => $this->getPluginManager()->get('hal')->createCollection($collection, 'fulbis.rpc.tournaments-teams')]);
    }
}
