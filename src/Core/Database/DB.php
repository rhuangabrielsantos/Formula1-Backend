<?php

namespace Core\Database;

use Api\Database\Connection\Memory;
use Api\Database\Connection\Postgres;
use Api\Database\Connection\SQLite;
use Api\Enum\StatusEnum;
use Doctrine\ORM\EntityManager;
use Exception;

final class DB
{
    /**
     * @return \Doctrine\ORM\EntityManager
     * @throws \Exception
     */
    public function getConnection(): EntityManager
    {
        $connection = $_ENV['DB_CONNECTION'];

        $configuredDatabase = $this->getConfiguredDatabase();

        if (!array_key_exists($connection, $configuredDatabase)) {
            throw new Exception('Database not configured', StatusEnum::NOT_FOUND);
        }

        return $configuredDatabase[$connection];
    }

    /**
     * @return array
     */
    private function getConfiguredDatabase(): array
    {
        return [
            'sqlite' => (new SQLite())->getEntity(),
            'postgres' => (new Postgres())->getEntity(),
            'memory' => (new Memory())->getEntity()
        ];
    }
}
