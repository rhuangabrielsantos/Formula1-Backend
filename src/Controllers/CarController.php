<?php

namespace Api\Controllers;

use Api\Entities\Car;
use Api\Enum\CommandInputEnum;
use Api\Enum\StatusEnum;
use Api\Messages\CarMessages;
use Api\Messages\RaceMessages;
use Api\Messages\RacingDriverMessages;
use Api\Repository\CarRepository;
use Api\Validations\CarValidator;
use Core\Controller\ControllerInterface;
use Core\Controller\ControllerResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\ORMException;

final class CarController implements ControllerInterface
{
    /**
     * @param int|null $id
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Exception
     */
    public function index(?int $id = null): ControllerResponse
    {
        if ($id !== 0 && $id !== null) {
            $car = (new CarRepository())->findById($id);
            $formattedCar = CarMessages::showCar($car);

            return (new ControllerResponse(StatusEnum::OK, $formattedCar));
        }

        $dataCars = (new CarRepository())->findAll();

        CarValidator::thereAreCars($dataCars);

        $dataCarsFormatted = [];

        /** @var Car $car */
        foreach($dataCars as $car) {
            $dataCarsFormatted[] = $car->toArray();
        }

        return (new ControllerResponse(StatusEnum::OK, 'Cars list', $dataCarsFormatted));
    }

    /**
     * @param array $requestBody
     * @return ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function create(array $requestBody): ControllerResponse
    {
        $car = new Car();

        $car->setRacingDriver($requestBody['racing_driver'] ?? null);
        $car->setBrand($requestBody['brand'] ?? null);
        $car->setModel($requestBody['model'] ?? null);
        $car->setColor($requestBody['color'] ?? null);
        $car->setYear($requestBody['year'] ?? null);
        $car->setPosition($requestBody['position'] ?? null);
        $car->setStatus('pending');
        $car->setHashCar(hash('sha512', $requestBody['racing_driver']) ?? null);

        try {
            (new CarRepository())->save($car);
        } catch (UniqueConstraintViolationException $e) {
            throw new \Exception(
                RacingDriverMessages::errorMessage_RacingDriverAlreadyExists(),
                StatusEnum::BAD_REQUEST
            );
        }

        $paramsResponse = [
            'status' => StatusEnum::CREATED,
            'hashCar' => $car->getHashCar()
        ];

        return (new ControllerResponse(StatusEnum::CREATED, 'Car was created', $paramsResponse));
    }

    /**
     * @param int $id
     * @param array $requestArguments
     * @return ControllerResponse
     */
    public function update(int $id, array $requestArguments): ControllerResponse
    {
        return (new ControllerResponse(StatusEnum::NOT_FOUND, 'Car cannot be upgraded'));
    }

    /**
     * @param int $id
     * @return ControllerResponse
     *
     * @throws ORMException
     */
    public function delete(int $id): ControllerResponse
    {
        $carRepository = new CarRepository();

        $car = $carRepository->findById($id);

        $carRepository->delete($car);

        $this->ifExistsCarsThenSetPosition();
        return (new ControllerResponse(StatusEnum::OK, 'Car has been deleted'));
    }

    /**
     * @param string $hashCar
     * @return \Core\Controller\ControllerResponse
     */
    public function findByHashCar(string $hashCar): ControllerResponse
    {
        $carRepository = new CarRepository();

        $car = $carRepository->findByHashCar($hashCar);

        if ($car) {
            return (new ControllerResponse(StatusEnum::OK, 'Car found', $car->toArray()));
        }

        return (new ControllerResponse(StatusEnum::NOT_FOUND, 'Car not found'));
    }

    /**
     * @param int $carId
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function acceptRace(int $carId): ControllerResponse
    {
        $carRepository = new CarRepository();

        $car = $carRepository->findById($carId);
        $car->setStatus('accepted');

        $carRepository->save($car);

        return (new ControllerResponse(StatusEnum::OK, 'Car accept the race'));
    }

    /**
     * @param int $carId
     * @param array $requestArguments
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function updateNumber(int $carId, array $requestArguments): ControllerResponse
    {
        $carRepository = new CarRepository();

        $car = $carRepository->findById($carId);
        $car->setNumber($requestArguments['number']);

        $carRepository->save($car);

        return (new ControllerResponse(StatusEnum::OK, 'Car accept the race'));
    }

    /**
     * @param int $carId
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function refuseRace(int $carId): ControllerResponse
    {
        $carRepository = new CarRepository();

        $car = $carRepository->findById($carId);
        $car->setStatus('pending');

        $carRepository->save($car);

        return (new ControllerResponse(StatusEnum::OK, 'Car accept the race'));
    }

    /**
     * @return \Core\Controller\ControllerResponse
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function updatePositions(): ControllerResponse
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->findAllOrderByNumber();

        /** @var Car $car */
        foreach ($cars as $car) {
            $this->delete($car->getId());
        }

        /** @var Car $car */
        foreach ($cars as $index => $car) {
            $car = [
                'racing_driver' => $car->getRacingDriver(),
                'brand' => $car->getBrand(),
                'model' => $car->getModel(),
                'color' => $car->getColor(),
                'year' => $car->getYear(),
                'position' => $index + 1
            ];

            $this->create($car);
        }

        return (new ControllerResponse(StatusEnum::OK, 'Cars updated'));
    }

    /**
     * @throws ORMException
     */
    private function ifExistsCarsThenSetPosition(): void
    {
        $dataCars = (new CarRepository())->findAll();

        if (count($dataCars) > 0) {
            $this->setPosition($dataCars);
        }
    }

    /**
     * @param array $dataCars
     * @return array
     *
     * @throws ORMException
     */
    public function setPosition(array $dataCars): array
    {
        $position = 1;

        /** @var Car $dataCar */
        foreach ($dataCars as $dataCar) {
            $dataCar->setPosition($position);

            (new CarRepository())->update($dataCar);

            $position++;
        }

        return $dataCars;
    }
}
