<?php

namespace Fulbis;

class DbAdapterFactory {

    public function __invoke($services) {

        $config = $services->get('Config')['doctrine']['connection']['orm_default']['params'];

        $config = [
            'driver' => 'Pdo_Mysql',
            'host' => $config['host'],
            'database' => $config['dbname'],
            'username' => $config['user'],
            'password' => $config['password']
        ];

        return new \Zend\Db\Adapter\Adapter($config);
    }

}