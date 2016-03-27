<?php

namespace Fulbis\Hydrator;

use Zend\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;

class Team extends ClassMethods {

    public function __construct($underscoreSeparatedKeys = true) {
        parent::__construct($underscoreSeparatedKeys);

        $this->addFilter(
            'tournament',
            new MethodMatchFilter('getTournament'),
            FilterComposite::CONDITION_AND
        );
    }

}