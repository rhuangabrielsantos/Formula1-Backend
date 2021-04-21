<?php

namespace Api\Entities;

/**
 * @ORM\Entity
 * @ORM\Table(name="reports")
 */
final class Report
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /** @ORM\Column(type="string") */
    private string $record;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecord(): string
    {
        return $this->record;
    }

    public function setRecord(string $record): self
    {
        $this->record = $record;
        return $this;
    }
}
