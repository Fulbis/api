<?php

namespace Fulbis\Test;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase as ZendAbstractHttpControllerTestCase;

abstract class AbstractHttpControllerTestCase extends ZendAbstractHttpControllerTestCase
{

    protected $connection;

    public function setUp() {
        $this->prepare();

        $_SERVER['HTTP_HOST'] = 'fulbis.dev';

        parent::setUp();

        $this->connection = $this->getEntityManager()->getConnection();

        $this->generateSchema();
    }

    protected function prepare() {
        $config = include __DIR__ . '/../../../../config/application.config.php';

        $config['module_listener_options']['config_glob_paths']
            = str_replace('local', 'local,test', $config['module_listener_options']['config_glob_paths']);

        $this->setApplicationConfig($config);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager() {
        return $this->getApplicationServiceLocator()->get('doctrine.entitymanager.orm_default');
    }

    /**
     * @return  \ZF\ContentNegotiation\Request
     */
    public function getRequest()
    {
        return parent::getRequest();
    }

    /**
     * @return  \Zend\Http\PhpEnvironment\Response
     */
    public function getResponse()
    {
        return parent::getResponse();
    }

    public function getArrayResponse($url, $method, $data = []) {
        /* reseteamos antes de cada dispatch(),
        por ejemplo el view helper url es compartido
        y a veces queda referenciando a una ruta anterior generando errores... no es muy eficiente :S */
        $this->reset();
        $this->prepare();

        /* lo unico que no podemos resetear es la conexion a la bdd porque sino perdemos la referencia
        a la base de datos en memoria de sqlite */
        $entityManager = $this->getEntityManager();
        $refObject   = new \ReflectionObject( $entityManager );
        $refProperty = $refObject->getProperty( 'conn' );
        $refProperty->setAccessible( true );
        $refProperty->setValue($entityManager, $this->connection);

        $request = $this->getRequest();

        if ($data) {
            $request->setContent(json_encode($data));
        }

        $request->getHeaders()->addHeaderLine('Accept', 'application/json');
        $request->getHeaders()->addHeaderLine('Content-Type', 'application/json');

        $this->dispatch($url, $method);

        return (object)[
                            'content' => json_decode($this->getResponse()->getContent(), true),
                            'status' => $this->getResponse()->getStatusCode()
                        ];
    }

    protected function generateSchema()
    {
        $metadata = $this->getMetadata();

        if ( ! empty($metadata)) {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($this->getEntityManager());
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
        return $this->getEntityManager()->getMetadataFactory()->getAllMetadata();
    }

}