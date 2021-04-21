<?php

namespace Api\Repository;

use Api\Entities\StatusRace;
use Core\Database\DB;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Exception;

final class StatusRaceRepository
{
    protected EntityManager $entityManager;

    /** @throws Exception */
    public function __construct()
    {
        $this->entityManager = (new DB())->getConnection();
    }

    /**
     * @throws ORMException
     */
    public function setStartRace(): void
    {
        /** @var StatusRace $statusRace */
        $statusRace = $this->entityManager->find('Api\Entities\StatusRace', 1);
        $statusRace->setStatus('on');

        $this->entityManager->persist($statusRace);
        $this->entityManager->flush();
    }

    /**
     * @throws ORMException
     */
    public function setFinishRace(): void
    {
        /** @var StatusRace $statusRace */
        $statusRace = $this->entityManager->find('Api\Entities\StatusRace', 1);
        $statusRace->setStatus('off');

        $this->entityManager->persist($statusRace);
        $this->entityManager->flush();
    }

    /**
     * @return string
     *
     * @throws ORMException
     */
    public function get(): string
    {
        /** @var StatusRace $statusRace */
        $statusRace = $this->entityManager->find('Api\Entities\StatusRace', 1);

        if (!$statusRace) {
            $statusRace = new StatusRace();
            $statusRace->setStatus('off');

            $this->entityManager->persist($statusRace);
            $this->entityManager->flush();

            return $statusRace->getStatus();
        }

        return $statusRace->getStatus();
    }
}
