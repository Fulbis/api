<?php

namespace Fulbis\Test;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase as ZendAbstractHttpControllerTestCase;

abstract class AbstractHttpControllerTestCase extends ZendAbstractHttpControllerTestCase
{

    /** @var  \Doctrine\ORM\EntityManager */
    protected $entityManager;

    public function setUp()
    {

        $config = include __DIR__ . '/../../../../config/application.config.php';

        $config['module_listener_options']['config_glob_paths']
            = str_replace('local', 'local,test', $config['module_listener_options']['config_glob_paths']);

        $this->setApplicationConfig($config);

        parent::setUp();

        $_SERVER['HTTP_HOST'] = 'fulbis.dev';

        $this->entityManager = $this->getApplicationServiceLocator()->get('doctrine.entitymanager.orm_default');

        $this->generateSchema();
    }

    /**
     * @return  \ZF\ContentNegotiation\Request
     */
    public function getRequest()
    {
        return parent::getRequest();
    }

    public function getArrayResponse($url, $method, $data = []) {
        $request = $this->getRequest();

        if ($data) {
            $request->setContent(json_encode($data));
        }

        $request->getHeaders()->addHeaderLine('Accept', 'application/json');
        $request->getHeaders()->addHeaderLine('Content-Type', 'application/json');

        $this->dispatch($url, $method);

        return json_decode($this->getResponse()->getContent(), true);
    }

    protected function generateSchema()
    {
        $metadata = $this->getMetadata();

        if ( ! empty($metadata)) {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($this->entityManager);
            $tool->createSchema($metadata);
        } else {
            throw new \Exception('No Metadata Classes to process.');
        }
    }

    /**
     * Overwrite this method to get specific metadata.
     *
     * @return Array
     */
    protected function getMetadata()
    {
        return $this->entityManager->getMetadataFactory()->getAllMetadata();
    }

}