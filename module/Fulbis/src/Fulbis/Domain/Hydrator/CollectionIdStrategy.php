<?php

namespace Fulbis\Domain\Hydrator;

use Doctrine\Common\Collections\Collection;
use DoctrineModule\Stdlib\Hydrator\Strategy\AllowRemoveByValue;

class CollectionIdStrategy extends AllowRemoveByValue
{
    public function extract($value)
    {
        if ($value instanceof Collection) {
            $return = array();
            foreach ($value as $entity) {
                $return[] = $entity->getId();
            }
            return $return;
        }
        return $value;
    }
}