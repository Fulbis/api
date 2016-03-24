<?php
namespace Fulbis\V1\Rpc\CreateTournamentMatches;

use Zend\Mvc\Controller\AbstractActionController;
use Fulbis\Core\Service;
use Fulbis\Core\FixtureGenerator;
use Fulbis\Core\Service\GenerateMatches;
use Fulbis\Core\Repository\Service\TournamentHasMatches;

class CreateTournamentMatchesController extends AbstractActionController
{
    private $service;
    private $fixtureGenerator;
    private $generateMatches;
    private $tournamentHasMatches;

    public function __construct(
                        Service $service, FixtureGenerator $fixtureGenerator,
                        GenerateMatches $generateMatches, TournamentHasMatches $tournamentHasMatches) {
        $this->service = $service;
        $this->fixtureGenerator = $fixtureGenerator;
        $this->generateMatches = $generateMatches;
        $this->tournamentHasMatches = $tournamentHasMatches;
    }

    public function createTournamentMatchesAction()
    {
        $tournamentId = $this->routeParam('tournament_id');

        /** @var \Fulbis\Core\Entity\Tournament $tournament */
        $tournament = $this->service->fetch(\Fulbis\Core\Entity\Tournament::class, $tournamentId);

        if (!$tournament) {
            $error = [
                "validation_messages" => ['tournament' => 'Invalid tournament id.']
            ];

            return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(422, 'Failed Validation', null, null, $error)
            );
        }

        if ($tournament->getTeams()->count() == 0) {
            $error = [
                "validation_messages" => ['tournament' => 'This tournament has no teams.']
            ];

            return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(422, 'Failed Validation', null, null, $error)
            );
        }

        if ($this->tournamentHasMatches->__invoke($tournamentId)) {
            $error = [
                "validation_messages" => ['tournament' => 'This tournament already has matches.']
            ];

            return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(422, 'Failed Validation', null, null, $error)
            );
        }

        $callback = function(\Fulbis\Core\Entity\Team $team){
            return $team->getId();
        };

        $teams = array_map($callback, $tournament->getTeams()->toArray());

        // TODO $double
        $double = false;

        $fixture = $this->fixtureGenerator->build($teams, $double);

        $this->generateMatches->generate($fixture);

        // TODO: return matches?
        return [];
    }
}
