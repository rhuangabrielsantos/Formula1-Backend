<?php

namespace Api\Entities;

use Api\Messages\RacingDriverMessages;
use InvalidArgumentException;

/**
 * @ORM\Entity
 * @ORM\Table(name="racing_driver")
 */
final class RacingDriver
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /** @ORM\Column(type="string") */
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        if (!$name) {
            throw new InvalidArgumentException(RacingDriverMessages::errorMessage_NameIsNull());
        }

        $this->name = $name;
        return $this;
    }
}
