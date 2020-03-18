<?php

namespace Models;

use Lib\StorageFactory;

class Car
{
    public function setCars(StorageFactory $storage, array $data)
    {
        $storage->setData('dataCars', $data);
    }
}
