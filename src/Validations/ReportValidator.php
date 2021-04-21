<?php

namespace Api\Validations;

use Api\Messages\ReportMessages;
use Exception;

final class ReportValidator
{
    /**
     * @param $reports
     * @throws Exception
     */
    public static function existsReports($reports): void
    {
        if (empty($reports)) {
            throw new Exception(ReportMessages::errorMessage_EmptyReport());
        }
    }
}
