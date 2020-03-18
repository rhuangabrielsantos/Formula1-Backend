<?php

namespace Lib;

class StorageFactory
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function getData(string $table)
    {
        return $this->storage->getData($table);
    }

    public function setData(string $table, array $data)
    {
        $this->storage->setData($table, $data);
    }
}