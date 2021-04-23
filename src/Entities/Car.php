<?php

namespace Api\Entities;

use Api\Messages\CarMessages;
use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity
 * @ORM\Table(name="cars",
 *     uniqueConstraints={ @UniqueConstraint(name="racing_driver_unique", columns={"racing_driver"}) }
 * )
 */
final class Car
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /** @ORM\Column(type="string") */
    public string $racing_driver;

    /** @ORM\Column(type="string") */
    public string $brand;

    /** @ORM\Column(type="string") */
    public string $model;

    /** @ORM\Column(type="string") */
    public string $color;

    /** @ORM\Column(type="integer", nullable=true) */
    public ?int $position;

    /** @ORM\Column(type="integer") */
    public int $year;

    /** @ORM\Column(type="string") */
    private string $hashCar;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRacingDriver(): string
    {
        return $this->racing_driver;
    }

    public function setRacingDriver(?string $racing_driver): self
    {
        if (!$racing_driver) {
            throw new InvalidArgumentException(CarMessages::errorMessage_InvalidArgumentsToCreateANewCar());
        }

        $this->racing_driver = $racing_driver;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        if (!$brand) {
            throw new InvalidArgumentException(CarMessages::errorMessage_InvalidArgumentsToCreateANewCar());
        }

        $this->brand = $brand;
        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        if (!$model) {
            throw new InvalidArgumentException(CarMessages::errorMessage_InvalidArgumentsToCreateANewCar());
        }

        $this->model = $model;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        if (!$color) {
            throw new InvalidArgumentException(CarMessages::errorMessage_InvalidArgumentsToCreateANewCar());
        }

        $this->color = $color;
        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        if (!$year) {
            throw new InvalidArgumentException(CarMessages::errorMessage_InvalidArgumentsToCreateANewCar());
        }

        if (!is_numeric($year)) {
            throw new InvalidArgumentException(CarMessages::errorMessage_YearNotInteger());
        }

        $this->year = (int)$year;
        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position ?? null;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function setHashCar(string $hashUser): self
    {
        $this->hashCar = $hashUser;

        return $this;
    }

    public function getHashCar(): string
    {
        return $this->hashCar;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'racing_driver' => $this->getRacingDriver(),
            'brand' => $this->getBrand(),
            'model' => $this->getModel(),
            'color' => $this->getColor(),
            'position' => $this->getPosition(),
            'year' => $this->getYear()
        ];
    }
}
