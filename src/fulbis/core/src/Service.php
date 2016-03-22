<?php

namespace Fulbis\Core;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

final class Service {

    private $em;
    private $hydrator;

    public function __construct(EntityManager $em, DoctrineHydrator $hydrator) {
        $this->em = $em;
        $this->hydrator = $hydrator;
    }

    /**
     * @param $entityName
     * @param array $data
     * @return object
     */
    public function create($entityName, array $data) {
        $entity = $this->hydrator->hydrate((array)$data, new $entityName);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param $entityName
     * @param $id
     * @param array $data
     * @return null|object
     */
    public function update($entityName, $id, array $data) {
        $entity = $this->fetch($entityName, $id);

        $entity = $this->hydrator->hydrate((array)$data, $entity);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param $entityName
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete($entityName, $id) {
        $entity = $this->em->getReference($entityName, $id);
        $this->em->remove($entity);
        $this->em->flush();

        return true;
    }

    /**
     * @param $entityName
     * @param $id
     * @return null|object
     */
    public function fetch($entityName, $id) {
        $repository = $this->em->getRepository($entityName);
        return $repository->find($id);
    }

    /**
     * @param $entityName
     * @param callable|null $callback
     * @return array
     */
    public function fetchAll($entityName, callable $callback = null) {
        $repository = $this->em->getRepository($entityName);

        $qb = $repository->createQueryBuilder('e');

        if ($callback) {
            $qb = $callback($qb);
        }

        return $qb->getQuery()->getResult();
    }

}