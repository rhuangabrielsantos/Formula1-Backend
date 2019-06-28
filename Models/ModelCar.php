<?php

namespace Models;

class ModelCar
{
    public static function setJson($file, $array)
    {
        $path = __DIR__ . "/../filesJson/" . $file . ".json";
        $json = json_encode($array, JSON_PRETTY_PRINT);
        file_put_contents($path, $json);
    }
}
