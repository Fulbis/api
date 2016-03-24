<?php

namespace Fulbis\Core\Repository\Service;

use Doctrine\DBAL\Connection;

class TournamentHasMatches {

    private $connection;

    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    public function __invoke($tournamentId) {
        $query = "SELECT COUNT(*) FROM fulbis_match m
        LEFT JOIN fulbis_team t1 on t1.id = m.team_1
        LEFT JOIN fulbis_team t2 on t2.id = m.team_2
        WHERE t1.tournament_id = :tournamentId OR t2.tournament_id = :tournamentId";

        return $this->connection->fetchColumn($query, ['tournamentId' => $tournamentId]);
    }

}