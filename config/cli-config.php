<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . '/env.php';

use Core\Database\DB;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

try {
    $entityManager = (new DB())->getConnection();
    return ConsoleRunner::createHelperSet($entityManager);
} catch (Exception $exception) {
    echo 'Erro ao obter conexão com o banco' . PHP_EOL;
    print_r($exception);
}
