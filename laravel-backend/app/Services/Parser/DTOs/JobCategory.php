<?php

namespace App\Services\Parser\DTOs;

class JobCategory
{
    private string $position;
    private ?string $stack;
    private string $level;

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return string|null
     */
    public function getStack(): ?string
    {
        return $this->stack;
    }

    /**
     * @param string|null $stack
     */
    public function setStack(?string $stack): void
    {
        $this->stack = $stack;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }
}
