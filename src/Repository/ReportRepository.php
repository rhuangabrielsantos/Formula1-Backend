<?php

namespace Api\Repository;

use Api\Entities\Report;
use Core\Database\DB;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Exception;

final class ReportRepository
{
    protected EntityRepository $reportRepository;
    protected EntityManager $entityManager;

    /** @throws Exception */
    public function __construct()
    {
        $this->entityManager = (new DB())->getConnection();
        $this->reportRepository = $this->entityManager->getRepository('Api\Entities\Report');
    }

    /**
     * @param Report $report
     *
     * @throws ORMException
     */
    public function create(Report $report): void
    {
        $this->entityManager->persist($report);
        $this->entityManager->flush();
    }

    /**
     * @throws ORMException
     */
    public function deleteAll(): void
    {
        $reports = $this->findAll();

        foreach ($reports as $report) {
            $this->entityManager->remove($report);
            $this->entityManager->flush();
        }
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->reportRepository->findAll();
    }
}
