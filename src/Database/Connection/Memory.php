<?php

namespace Api\Database\Connection;

use Core\Database\DriverDB;
use Doctrine\ORM\EntityManager as Entity;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

final class Memory implements DriverDB
{
    private Entity $entity;

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
            'memory' => true
        ];

        try {
            $this->entity = Entity::create($connection, $configuration);
        } catch (ORMException $exception) {
            die("Database not connected!");
        }
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }
}
