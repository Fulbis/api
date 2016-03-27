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

        if ($this->getRequest()->getMethod() == 'POST') {
            $POST = json_decode($this->getRequest()->getContent(), true);
            $teams = $this->createTeams($POST['teams'], $tournamentId);
        } else {
            // GET
            $teams = $this->getTeams($tournamentId);
        }

        $collection = new \ZF\Hal\Collection($teams, 'fulbis.rest.teams');
        $collection->setCollectionName('teams');

        return new ViewModel(['payload' => $this->getPluginManager()->get('hal')->createCollection($collection, 'fulbis.rpc.tournaments-teams')]);
    }

    private function createTeams(array $teamNames, $tournamentId) {
        $teams = [];

        foreach($teamNames as $teamName) {
            $teams[] = $this->service->create(\Fulbis\Core\Entity\Team::class, ['name' => $teamName, 'tournament' => $tournamentId]);
        }

        return $teams;
    }

    private function getTeams($tournamentId) {
        $callback = function(QueryBuilder $queryBuilder) use ($tournamentId) {
            return $queryBuilder
                ->leftJoin('e.tournament', 't')
                ->where('t.id=:tournamentId')
                ->setParameter('tournamentId', $tournamentId);
        };

        $teams = $this->service->fetchAll(\Fulbis\Core\Entity\Team::class, $callback);

        return $teams;
    }
}
