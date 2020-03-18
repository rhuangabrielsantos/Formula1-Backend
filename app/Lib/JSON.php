<?php

namespace Lib;

class JSON implements Storage
{
    public function getData(string $fileName)
    {
        return json_decode(file_get_contents(__DIR__ . '/../../database/' . $fileName . '.json'), true);
    }

    public function setData(string $fileName, array $data)
    {
        $path = __DIR__ . "/../../database/" . $fileName . ".json";
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }
}
