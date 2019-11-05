<?php

namespace Lib;

class JSON
{
    public static function getJson($file)
    {
        return json_decode(file_get_contents(__DIR__ . '/../filesJson/' . $file . '.json'), true);
    }

    public static function setJson(string $file, array $data)
    {
        $path = __DIR__ . "/../filesJson/" . $file . ".json";
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }
}
