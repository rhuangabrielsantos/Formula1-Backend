<?php

namespace Api\Database\Connection;

use Core\Database\DriverDB;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

final class Postgres implements DriverDB
{
    private EntityManager $entity;

    public function __construct()
    {
        $configuration = Setup::createAnnotationMetadataConfiguration(
            $path = [__DIR__ . '/../../'],
            $isDevMode = true,
            $proxyDir = null,
            $cache = null,
            $useSimpleAnnotationReader = false
        );

        $connection = [
            'driver' => 'pdo_pgsql',
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME'],
        ];

        try {
            $this->entity = EntityManager::create($connection, $configuration);
        } catch (ORMException $exception) {
            die("Database not connected!");
        }
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntity(): EntityManager
    {
        return $this->entity;
    }
}
