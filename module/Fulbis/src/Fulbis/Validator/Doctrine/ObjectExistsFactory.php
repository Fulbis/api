<?php

namespace Fulbis\Validator\Doctrine;

use Zend\ServiceManager\ServiceManager;
use DoctrineModule\Validator\ObjectExists;

class ObjectExistsFactory {

    /**
     * @var array
     */
    protected $options = array();

    /**
     * Sets options property
     *
     * @param array $options
     */
    public function setCreationOptions(array $options)
    {
        $this->options = $options;
    }

    public function __invoke(ServiceManager $container) {
        $entityManager = $container->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        $options = $this->options;
        $options['object_repository'] = $entityManager->getRepository($options['entity']);

        return new ObjectExists($options);

    }

}

