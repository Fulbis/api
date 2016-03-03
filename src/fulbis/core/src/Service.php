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

        $this->hydrator->addStrategy('teams', new Hydrator\CollectionIdStrategy());
        $this->hydrator->addStrategy('players', new Hydrator\CollectionIdStrategy());
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

    /**
     * @param $entityName
     * @param $id
     * @return null|\Fulbis\Core\Entity\VersionableInterface
     */
    public function fetch($entityName, $id) {
        $repository = $this->em->getRepository($entityName);
        return $this->hydrator->extract($repository->findOneBy(['id' => $id, 'deleted' => 0], ['id_auto' => 'DESC'], 1));
    }

    public function fetchAll($entityName, callable $callback = null) {
        $repository = $this->em->getRepository($entityName);

        $subQuery = $repository->createQueryBuilder('subE')->select('MAX(subE.id_auto)')->groupBy('subE.id')->getDQL();

        $qb = $repository->createQueryBuilder('e')
                    ->where('e.deleted = 0')
                    ->andWhere('e.id_auto IN ('.$subQuery.')')
                    ->orderBy('e.id_auto', 'DESC');

        if ($callback) {
            $qb = $callback($qb);
        }

        return array_map([$this->hydrator, 'extract'], $qb->getQuery()->getResult());
    }

}