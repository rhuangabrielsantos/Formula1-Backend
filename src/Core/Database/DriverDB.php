<?php

namespace Core\Database;

use Doctrine\ORM\EntityManager;

interface DriverDB
{
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntity(): EntityManager;
}
