<?php

namespace Api\Services;

use Api\Entities\Report;
use Api\Enum\StatusEnum;
use Api\Repository\ReportRepository;
use Api\Validations\ReportValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;

final class ShowReportsService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     *
     * @throws \Exception
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        $reports = (new ReportRepository())->findAll();

        ReportValidator::existsReports($reports);

        $formattedReport = '';

        /** @var Report $report */
        foreach ($reports as $report) {
            $formattedReport .= $report->getRecord();
        }

        return new CommandResponse(StatusEnum::OK, $formattedReport);
    }
}
