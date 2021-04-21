<?php

namespace Api\Services;

use Api\Entities\Report;
use Api\Enum\StatusEnum;
use Api\Repository\ReportRepository;
use Api\Validations\ReportValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;
use Exception;

final class ShowReportsService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        try {
            $reports = (new ReportRepository())->findAll();

            ReportValidator::existsReports($reports);

            $formattedReport = '';

            /** @var Report $report */
            foreach ($reports as $report) {
                $formattedReport .= $report->getRecord() . PHP_EOL;
            }

            return new CommandResponse(StatusEnum::OK, $formattedReport);
        } catch (Exception $exception) {

            return new CommandResponse(StatusEnum::ERROR, $exception->getMessage());
        }
    }
}
