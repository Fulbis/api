<?php

namespace Fulbis\Core\Repository;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\AbstractFactoryInterface;

class AbstractFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        return substr($requestedName, 0, 18) == 'Fulbis\\Repository\\';
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $entity = substr($requestedName, 18);

        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');

        $repository = $em->getRepository('Fulbis\Core\Entity\\'.$entity);

        return $repository;
    }
}