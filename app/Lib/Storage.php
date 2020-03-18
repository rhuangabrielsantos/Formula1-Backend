<?php

namespace Lib;

interface Storage
{
    public function getData(string $file);

    public function setData(string $file, array $data);
}