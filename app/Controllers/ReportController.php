<?php

namespace Controllers;

use Lib\Storage;

class ReportController
{
    public function cleanReports()
    {
        (new Storage())->setReports([]);
    }
}