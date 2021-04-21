<?php

namespace Api\Database\Connection;

use Core\Database\DriverDB;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

final class SQLite implements DriverDB
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
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../../database/db.sqlite'
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
