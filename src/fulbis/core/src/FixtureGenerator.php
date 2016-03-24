<?php

namespace Fulbis\Core;

/*
 * Based on https://gist.github.com/troyswanson/8226211
 */
class FixtureGenerator {

    public function build($teams, $double = false) {

        $emptyTeam = null;

        if((count($teams) % 2) == 1) {
            array_unshift($teams, $emptyTeam);
        }

        $fixedTeam = array_slice($teams, 0, 1);
        $rotatingTeams = array_slice($teams, 1);

        $fixture = [];

        //find half minus one offset
        $offset = (count($teams)/2)-1;

        for($i = 1; $i < count($teams); $i++) {
            //slice the teams for first set and put fixed team at beginning of the first set
            $setOne = array_merge($fixedTeam, array_slice($rotatingTeams, 0, $offset));

            //create second set of teams
            $setTwo = array_reverse(array_slice($rotatingTeams, $offset));

            //create the matchups
            for($j = 0; $j < count($teams)/2; $j++) {
                $fixture[$i][$j] = array($setOne[$j], $setTwo[$j]);
            }

            //rotate the teams
            array_unshift($rotatingTeams, array_pop($rotatingTeams));
        }

        if ($double) {
            $reverseGames = function($games) use ($emptyTeam) {
                $reverse = array_map('array_reverse', $games);
                if ($reverse[0][1] == $emptyTeam) {
                    $reverse[0] = array_reverse($reverse[0]);
                }
                return $reverse;
            };
            $fixture = array_merge($fixture, array_map($reverseGames, $fixture));
        }

        return $fixture;
    }

}