<?php

namespace Fulbis\Domain;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

final class Service {

    private $em;
    private $hydrator;

    public function __construct(EntityManager $em, DoctrineHydrator $hydrator) {
        $this->em = $em;
        $this->hydrator = $hydrator;
    }

    public function create($entityName, array $data) {
        $entity = $this->hydrator->hydrate((array)$data, new $entityName);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update($entityName, $id, array $data) {
        $entity = $this->fetch($entityName, $id);

        $entity = clone $entity;

        $entity->setIdAuto(null);

        $entity = $this->hydrator->hydrate((array)$data, $entity);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function delete($entityName, $id) {
        $q = $this->em->createQuery('UPDATE '.$entityName.' e set e.deleted = 1 WHERE e.id = :id');
        return $q->execute(['id' => $id]);
    }

    public function fetch($entityName, $id) {
        $repository = $this->em->getRepository($entityName);
        return $repository->findOneBy(['id' => $id, 'deleted' => 0], ['id_auto' => 'DESC'], 1);
    }

    public function fetchAll($entityName) {
        $repository = $this->em->getRepository($entityName);

        $qb = $repository->createQueryBuilder('e')
                    ->where('e.deleted = 0')
                    ->orderBy('e.id_auto', 'DESC')
                    ->groupBy('e.id');

        return $qb->getQuery()->getResult();
    }

}