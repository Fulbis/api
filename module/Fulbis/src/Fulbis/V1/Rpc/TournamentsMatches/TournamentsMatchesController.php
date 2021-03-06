<?php
namespace Fulbis\V1\Rpc\TournamentsMatches;

use Doctrine\ORM\QueryBuilder;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;
use ZF\ContentNegotiation\ViewModel;
use Fulbis\Core\Service;

class TournamentsMatchesController extends AbstractActionController
{
    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    public function tournamentsMatchesAction()
    {
        $tournamentId = $this->routeParam('tournament_id');

        $callback = function(QueryBuilder $queryBuilder) use ($tournamentId) {
            return $queryBuilder
                ->leftJoin('e.team1', 't1')
                ->leftJoin('t1.tournament', 't')
                ->where('t.id=:tournamentId')
                ->orderBy('e.gameNumber', 'ASC')
                ->setParameter('tournamentId', $tournamentId);
        };

        $matches = $this->service->fetchAll(\Fulbis\Core\Entity\Match::class, $callback);

        /** @var \ZF\Hal\Plugin\Hal $hal */
        $hal = $this->getPluginManager()->get('hal');

        $metadataMap = $hal->getMetadataMap()->get(\Fulbis\Core\Entity\Team::class);

        if ($metadataMap) {
            $metadataMap->getHydrator()->addFilter(
                'players',
                new MethodMatchFilter('getPlayers'),
                FilterComposite::CONDITION_AND
            );
        }

        $collection = new \ZF\Hal\Collection($matches, 'fulbis.rest.matches');
        $collection->setCollectionName('matches');

        return new ViewModel(['payload' => $hal->createCollection($collection, 'fulbis.rpc.tournaments-matches')]);
    }

}
