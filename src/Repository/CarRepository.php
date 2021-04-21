<?php

namespace Api\Repository;

use Api\Entities\Car;
use Core\Database\DB;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMException;
use Exception;

final class CarRepository
{
    protected EntityRepository $carRepository;
    protected EntityManager $entityManager;

    /** @throws Exception */
    public function __construct()
    {
        $this->entityManager = (new DB())->getConnection();
        $this->carRepository = $this->entityManager->getRepository('Api\Entities\Car');
    }

    /**
     * @param Car $car
     *
     * @throws ORMException
     */
    public function create(Car $car): void
    {
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->carRepository->findBy([], ['position' => 'ASC']);
    }

    /**
     * @param Car $car
     *
     * @throws ORMException
     */
    public function delete(Car $car): void
    {
        $this->entityManager->remove($car);
        $this->entityManager->flush();
    }

    /**
     * @param Car $car
     *
     * @throws ORMException
     */
    public function update(Car $car): void
    {
        /** @var Car $carEntity */
        $carEntity = $this->entityManager->find('Api\Entities\Car', $car->getId());

        $carEntity->setRacingDriver($car->getRacingDriver());
        $carEntity->setBrand($car->getBrand());
        $carEntity->setModel($car->getModel());
        $carEntity->setColor($car->getColor());
        $carEntity->setYear($car->getYear());
        $carEntity->setPosition($car->getPosition());

        $this->entityManager->persist($carEntity);
        $this->entityManager->flush();
    }

    /**
     * @param string $name
     * @return \Api\Entities\Car
     */
    public function findByName(string $name): Car
    {
        return $this->carRepository->findOneBy(['racing_driver' => $name]);
    }

    /**
     * @param int|null $position
     * @return \Api\Entities\Car
     */
    public function findByPosition(?int $position): Car
    {
        return $this->carRepository->findOneBy(['position' => $position]);
    }

    /**
     * @param int $id
     * @return \Api\Entities\Car
     */
    public function findById(int $id): Car
    {
        return $this->carRepository->findOneBy(['id' => $id]);
    }
}
